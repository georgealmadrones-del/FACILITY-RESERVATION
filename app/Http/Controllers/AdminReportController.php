<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Facility;
use App\Models\Equipment;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function dashboard()
    {
        $totalReservations = Reservation::count();
        $approvedCount = Reservation::where('status', 'approved')->count();
        $pendingCount = Reservation::where('status', 'pending')->count();
        $rejectedCount = Reservation::where('status', 'rejected')->count();
        $recentReservations = Reservation::with(['user', 'facility', 'equipment'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalReservations', 
            'approvedCount', 
            'pendingCount', 
            'rejectedCount', 
            'recentReservations'
        ));
    }

    public function index(Request $request)
    {
        $status = $request->input('status');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $query = Reservation::with(['user', 'facility', 'equipment']);

        if ($status) {
            $query->where('status', $status);
        }

        if ($dateFrom) {
            $query->whereDate('start_time', '>=', $dateFrom);
        }

        if ($dateTo) {
            $query->whereDate('end_time', '<=', $dateTo);
        }

        $reservations = $query->latest()->paginate(15);

        $totalReservations = Reservation::count();
        $approvedCount = Reservation::where('status', 'approved')->count();
        $pendingCount = Reservation::where('status', 'pending')->count();
        $rejectedCount = Reservation::where('status', 'rejected')->count();

        return view('admin.reports.index', compact(
            'reservations', 
            'totalReservations', 
            'approvedCount', 
            'pendingCount', 
            'rejectedCount'
        ));
    }

    // --- Resource Management Methods ---

    public function manageResources()
    {
        $facilities = Facility::latest()->get();
        $equipment = Equipment::latest()->get();
        
        return view('admin.resources', compact('facilities', 'equipment'));
    }

    public function storeFacility(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        Facility::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'available',
        ]);

        return back()->with('success', 'Facility added successfully!');
    }

    public function destroyFacility(Facility $facility)
    {
        $facility->delete();
        
        return back()->with('success', 'Facility removed successfully!');
    }

    public function storeEquipment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);

        Equipment::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'available',
        ]);

        return back()->with('success', 'Equipment added successfully!');
    }

    public function destroyEquipment(Equipment $equipment)
    {
        $equipment->delete();
        
        return back()->with('success', 'Equipment removed successfully!');
    }
}