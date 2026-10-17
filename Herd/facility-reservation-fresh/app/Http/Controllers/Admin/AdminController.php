<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Facility;
use App\Models\Equipment;
use App\Notifications\ReservationStatusChanged;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalBookings = Reservation::count();
        $approvedCount = Reservation::where('status', 'approved')->count();
        $pendingCount = Reservation::where('status', 'pending')->count();
        $rejectedCount = Reservation::where('status', 'rejected')->count();

        // Updated variable name to $reservations to match the dashboard view
        $reservations = Reservation::with(['user', 'facility', 'equipment'])->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalBookings', 'approvedCount', 'pendingCount', 'rejectedCount', 'reservations'));
    }

    public function reservations()
    {
        $reservations = Reservation::with(['user', 'facility', 'equipment'])->latest()->paginate(15);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function showReservation(Reservation $reservation)
    {
        return view('admin.reservations.show', compact('reservation'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,cancelled',
            'rejection_reason' => 'required_if:status,rejected|nullable|string|max:500',
        ]);

        $reservation->update([
            'status' => $request->status,
            'rejection_reason' => $request->status === 'rejected' ? $request->rejection_reason : null,
        ]);

        // Dispatch database notification to the user directly
        $reservation->user->notify(new ReservationStatusChanged($reservation));

        return back()->with('success', 'Reservation status updated successfully!');
    }

    public function reports(Request $request)
    {
        $query = Reservation::with(['user', 'facility', 'equipment']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('start_time', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('start_time', '<=', $request->date_to);
        }

        // Calculate metrics for filtered reports view
        $totalFiltered = (clone $query)->count();
        $approvedCount = (clone $query)->where('status', 'approved')->count();
        $pendingCount  = (clone $query)->where('status', 'pending')->count();
        $rejectedCount = (clone $query)->where('status', 'rejected')->count();

        $reservations = $query->latest()->paginate(20)->withQueryString();

        return view('admin.reports.index', compact(
            'reservations',
            'totalFiltered',
            'approvedCount',
            'pendingCount',
            'rejectedCount'
        ));
    }

    public function exportPdf(Request $request)
    {
        $query = Reservation::with(['user', 'facility', 'equipment']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('start_time', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('start_time', '<=', $request->date_to);
        }

        $reservations = $query->latest()->get();

        $pdf = Pdf::loadView('admin.reports.pdf', compact('reservations'));

        return $pdf->download('reservation-reports-' . date('Y-m-d') . '.pdf');
    }

    public function resources()
    {
        $facilities = Facility::latest()->get();
        $equipment = Equipment::latest()->get();

        return view('admin.resources.index', compact('facilities', 'equipment'));
    }

    public function storeFacility(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        Facility::create($request->all());

        return back()->with('success', 'Facility created successfully!');
    }

    public function updateFacility(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $facility->update($request->all());

        return back()->with('success', 'Facility updated successfully!');
    }

    public function destroyFacility(Facility $facility)
    {
        $facility->delete();

        return back()->with('success', 'Facility deleted successfully!');
    }

    public function storeEquipment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_stock' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        Equipment::create($request->all());

        return back()->with('success', 'Equipment added successfully!');
    }

    public function updateEquipment(Request $request, Equipment $equipment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'total_stock' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        $equipment->update($request->all());

        return back()->with('success', 'Equipment updated successfully!');
    }

    public function destroyEquipment(Equipment $equipment)
    {
        $equipment->delete();

        return back()->with('success', 'Equipment deleted successfully!');
    }
}