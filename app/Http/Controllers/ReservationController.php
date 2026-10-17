<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Equipment;
use App\Models\Reservation;
use App\Notifications\ReservationStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        
        // Map equipment with real-time dynamic available stock calculation for creation form view
        $equipment = Equipment::whereIn('status', ['available', 'Available'])->get()->map(function($item) {
            $bookedCount = $item->reservations()
                ->whereIn('status', ['pending', 'approved'])
                ->where('end_time', '>=', now())
                ->sum('quantity');
                
            $item->live_available_stock = max(0, $item->total_stock - $bookedCount);
            return $item;
        });

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

        $start = Carbon::parse($request->start_time)->toDateTimeString();
        $end = Carbon::parse($request->end_time)->toDateTimeString();
        $userId = Auth::id();

        // 0. DUPLICATE SUBMISSION CHECK
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

        // 1. FACILITY CONFLICT DETECTION
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

        // 2. EQUIPMENT QUANTITY & OVERLAP DETECTION
        if ($request->equipment_id) {
            $equipment = Equipment::findOrFail($request->equipment_id);
            $requestedQty = (int) ($request->quantity ?? 1);

            if ($requestedQty < 1) {
                return back()->withInput()->withErrors([
                    'quantity' => 'The quantity must be at least 1 when booking equipment.'
                ]);
            }

            $bookedQuantity = Reservation::where('equipment_id', $request->equipment_id)
                ->whereIn('status', ['pending', 'approved'])
                ->where(function ($query) use ($start, $end) {
                    $query->where('start_time', '<', $end)
                          ->where('end_time', '>', $start);
                })->sum('quantity');

            $availableStock = max(0, $equipment->total_stock - $bookedQuantity);

            if (($bookedQuantity + $requestedQty) > $equipment->total_stock) {
                return back()->withInput()->withErrors([
                    'quantity' => "Conflict Error: Only {$availableStock} units of this equipment are available for the selected time window."
                ]);
            }
        }

        // 3. DATABASE TRANSACTION FOR SAFE CREATION
        DB::transaction(function () use ($request, $start, $end, $userId) {
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
        });

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

        return DB::transaction(function () use ($request, $reservation, $user) {
            if (!$user->isAdmin()) {
                if ($request->status === 'cancelled' && $reservation->user_id === $user->id) {
                    $reservation->update(['status' => 'cancelled']);
                    
                    if ($reservation->equipment_id) {
                        $equipment = Equipment::lockForUpdate()->find($reservation->equipment_id);
                        if ($equipment) {
                            $equipment->increment('total_stock', $reservation->quantity ?? 1);
                        }
                    }

                    return back()->with('success', 'Reservation cancelled successfully!');
                }
                abort(403);
            }

            $oldStatus = $reservation->status;
            $reservation->update([
                'status' => $request->status,
                'rejection_reason' => $request->status === 'rejected' ? $request->rejection_reason : null,
            ]);

            if (in_array($request->status, ['rejected', 'cancelled']) && $oldStatus !== 'rejected' && $oldStatus !== 'cancelled') {
                if ($reservation->equipment_id) {
                    $equipment = Equipment::lockForUpdate()->find($reservation->equipment_id);
                    if ($equipment) {
                        $equipment->increment('total_stock', $reservation->quantity ?? 1);
                    }
                }
            }

            try {
                $reservation->user->notify(new ReservationStatusChanged($reservation));
            } catch (\Exception $e) {
                // Fail silently
            }

            return redirect()->route('admin.reservations.index')->with('success', 'Reservation status updated successfully!');
        });
    }

    public function destroy(Reservation $reservation)
    {
        return DB::transaction(function () use ($reservation) {
            if ($reservation->equipment_id && in_array($reservation->status, ['pending', 'approved'])) {
                $equipment = Equipment::lockForUpdate()->find($reservation->equipment_id);
                if ($equipment) {
                    $equipment->increment('total_stock', $reservation->quantity ?? 1);
                }
            }

            $reservation->delete();

            return back()->with('success', 'Reservation cancelled and stock restored.');
        });
    }

    public function availability(Request $request)
    {
        $facilities = Facility::whereIn('status', ['available', 'Available'])
            ->with(['reservations' => function ($query) {
                $query->where('status', 'approved')
                      ->where('end_time', '>=', now())
                      ->orderBy('start_time', 'asc');
            }})->get();

        $equipment = Equipment::whereIn('status', ['available', 'Available'])
            ->with(['reservations' => function ($query) {
                $query->where('status', 'approved')
                      ->where('end_time', '>=', now())
                      ->orderBy('start_time', 'asc');
            }})->get()->map(function($item) {
                $bookedCount = $item->reservations()
                    ->whereIn('status', ['pending', 'approved'])
                    ->where('end_time', '>=', now())
                    ->sum('quantity');
                    
                $item->live_available_stock = max(0, $item->total_stock - $bookedCount);
                return $item;
            });

        return view('reservations.availability', compact('facilities', 'equipment'));
    } 

    public function studentDashboard()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $myReservations = $user->reservations()->with(['facility', 'equipment'])->latest()->get();
        $facilities = Facility::whereIn('status', ['available', 'Available'])->get();
        
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