<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Equipment;
use App\Models\Reservation;
use App\Notifications\ReservationStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Admins see all reservations across the system
            $reservations = Reservation::with(['user', 'facility', 'equipment'])->latest()->get();
            return view('admin.reservations.index', compact('reservations'));
        }

        // Students only see their own reservations
        $reservations = $user->reservations()->with(['facility', 'equipment'])->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $facilities = Facility::whereIn('status', ['available', 'Available'])->get();
        $equipment = Equipment::whereIn('status', ['available', 'Available'])->get();

        return view('reservations.create', compact('facilities', 'equipment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'nullable|required_without:equipment_id|exists:facilities,id',
            'equipment_id' => 'nullable|required_without:facility_id|exists:equipment,id',
            'quantity' => 'nullable|integer|min:0',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'purpose' => 'required|string|max:1000',
        ]);

        // Parse dates to prevent datetime-local format mismatch/false conflicts
        $start = Carbon::parse($request->start_time)->toDateTimeString();
        $end = Carbon::parse($request->end_time)->toDateTimeString();
        $userId = Auth::id();

        // 0. DUPLICATE SUBMISSION CHECK (Prevent same user booking twice simultaneously)
        $duplicateCheck = Reservation::where('user_id', $userId)
            ->where('start_time', $start)
            ->where('end_time', $end)
            ->whereIn('status', ['pending', 'approved'])
            ->when($request->facility_id, function($q) use ($request) {
                return $q->where('facility_id', $request->facility_id);
            })
            ->when($request->equipment_id, function($q) use ($request) {
                return $q->where('equipment_id', $request->equipment_id);
            })
            ->exists();

        if ($duplicateCheck) {
            return back()->withInput()->withErrors([
                'start_time' => 'Duplicate Notice: You already have a pending or approved request for this item during this exact time slot.'
            ]);
        }

        // 1. FACILITY CONFLICT DETECTION (Prevent Double-Booking Rooms)
        if ($request->facility_id) {
            $facilityConflict = Reservation::where('facility_id', $request->facility_id)
                ->whereIn('status', ['pending', 'approved'])
                ->where(function ($query) use ($start, $end) {
                    $query->where('start_time', '<', $end)
                          ->where('end_time', '>', $start);
                })->exists();

            if ($facilityConflict) {
                return back()->withInput()->withErrors([
                    'start_time' => 'Conflict Error: This facility is already reserved or has a pending request during this time slot.'
                ]);
            }
        }

        // 2. EQUIPMENT QUANTITY & OVERLAP DETECTION (Dynamic stock calculation)
        if ($request->equipment_id) {
            $equipment = Equipment::findOrFail($request->equipment_id);
            $requestedQty = (int) ($request->quantity ?? 0);

            if ($requestedQty < 1) {
                return back()->withInput()->withErrors([
                    'quantity' => 'The quantity must be at least 1 when booking equipment.'
                ]);
            }

            // Sum up units already booked in this time window
            $bookedQuantity = Reservation::where('equipment_id', $request->equipment_id)
                ->whereIn('status', ['pending', 'approved'])
                ->where(function ($query) use ($start, $end) {
                    $query->where('start_time', '<', $end)
                          ->where('end_time', '>', $start);
                })->sum('quantity');

            // Check if remaining stock is sufficient
            if (($bookedQuantity + $requestedQty) > $equipment->total_stock) {
                $availableStock = max(0, $equipment->total_stock - $bookedQuantity);
                return back()->withInput()->withErrors([
                    'quantity' => "Conflict Error: Only {$availableStock} units of this equipment are available for the selected time window."
                ]);
            }
        }

        // 3. CREATE THE RESERVATION (Passed all checks!)
        Reservation::create([
            'user_id' => $userId,
            'facility_id' => $request->facility_id,
            'equipment_id' => $request->equipment_id,
            'quantity' => $request->equipment_id ? ($request->quantity ?? 1) : null,
            'start_time' => $start,
            'end_time' => $end,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        // Redirect to My Reservations with success banner
        return redirect()->route('reservations.index')->with('success', 'Booked successfully!');
    }

    public function showApproveForm(Reservation $reservation)
    {
        return view('admin.reservations.approve', compact('reservation'));
    }

    public function showRejectForm(Reservation $reservation)
    {
        return view('admin.reservations.reject', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $user = Auth::user();

        $request->validate([
            'status' => 'required|in:approved,rejected,cancelled',
            'rejection_reason' => 'required_if:status,rejected|nullable|string|max:500',
        ]);

        // Allow users to cancel their own reservations regardless of current status
        if (!$user->isAdmin()) {
            if ($request->status === 'cancelled' && $reservation->user_id === $user->id) {
                $reservation->update(['status' => 'cancelled']);
                return back()->with('success', 'Reservation cancelled successfully!');
            }
            abort(403);
        }

        // Admin updates status directly along with the rejection reason if applicable
        $reservation->update([
            'status' => $request->status,
            'rejection_reason' => $request->status === 'rejected' ? $request->rejection_reason : null,
        ]);

        // Send real-time database notification to the student
        try {
            $reservation->user->notify(new ReservationStatusChanged($reservation));
        } catch (\Exception $e) {
            // Fail silently if notification dispatch encounters an issue
        }

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation status updated successfully!');
    }

    public function availability(Request $request)
    {
        // Fetch all active facilities and equipment along with their approved upcoming reservations
        $facilities = Facility::whereIn('status', ['available', 'Available'])
            ->with(['reservations' => function ($query) {
                $query->where('status', 'approved')
                      ->where('end_time', '>=', now())
                      ->orderBy('start_time', 'asc');
            }])->get();

        $equipment = Equipment::whereIn('status', ['available', 'Available'])
            ->with(['reservations' => function ($query) {
                $query->where('status', 'approved')
                      ->where('end_time', '>=', now())
                      ->orderBy('start_time', 'asc');
            }])->get();

        return view('reservations.availability', compact('facilities', 'equipment'));
    } 

    public function studentDashboard()
    {
        $user = Auth::user();

        // Redirect admins to the admin command center dashboard
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $myReservations = $user->reservations()->with(['facility', 'equipment'])->latest()->get();
        $facilities = Facility::whereIn('status', ['available', 'Available'])->get();
        
        // Calculate live available stock for each equipment item
        $equipment = Equipment::whereIn('status', ['available', 'Available'])->get()->map(function($item) {
            $bookedCount = $item->reservations()
                ->whereIn('status', ['pending', 'approved'])
                ->where('end_time', '>=', now())
                ->sum('quantity');
                
            $item->live_available_stock = max(0, $item->total_stock - $bookedCount);
            return $item;
        });

        return view('dashboard', compact('myReservations', 'facilities', 'equipment'));
    }
}