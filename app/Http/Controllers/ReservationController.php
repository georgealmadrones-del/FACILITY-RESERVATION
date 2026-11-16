<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Facility;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Display dashboard with user reservations
    public function index()
    {
        $reservations = Auth::user()->reservations()->latest()->get();
        $facilities = Facility::all();
        $equipment = Equipment::all();
        return view('dashboard', compact('reservations', 'facilities', 'equipment'));
    }

    // Store a new reservation request
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resource_type' => 'required|string',
            'resource_name' => 'required|string',
            'category' => 'required|string',
            'purpose' => 'required|string',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'quantity' => 'required|integer',
        ]);

        Auth::user()->reservations()->create([
            'resource_type' => $validated['resource_type'],
            'resource_name' => $validated['resource_name'],
            'category' => $validated['category'],
            'purpose' => $validated['purpose'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'quantity' => $validated['quantity'],
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Reservation submitted successfully!');
    }

    // Cancel a reservation (User action)
    public function cancel($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if ($reservation->status === 'pending' || $reservation->status === 'approved') {
            $reservation->update(['status' => 'cancelled']);
            return back()->with('success', 'Reservation has been cancelled.');
        }

        return back()->with('error', 'This reservation can no longer be cancelled.');
    }

    // Return a borrowed unit/equipment (User action)
    public function returnUnit($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($reservation->status === 'approved' && $reservation->resource_type === 'equipment') {
            $reservation->update(['status' => 'returned']);
            return back()->with('success', 'Equipment successfully returned.');
        }

        return back()->with('error', 'Unable to process return for this item.');
    }

    // ==================== ADMIN DATABASE METHODS ====================

    public function adminIndex()
    {
        $reservations = Reservation::latest()->get();
        $facilities = Facility::all();
        $equipment = Equipment::all();
        $users = User::all();

        return view('admin.dashboard', compact('reservations', 'facilities', 'equipment', 'users'));
    }

    public function approve($id)
    {
        Reservation::findOrFail($id)->update(['status' => 'approved']);
        return back()->with('success', 'Reservation approved.');
    }

    public function reject($id)
    {
        Reservation::findOrFail($id)->update(['status' => 'cancelled']);
        return back()->with('success', 'Reservation rejected.');
    }

    // Facility CRUD
    public function storeFacility(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string', 'capacity' => 'required|integer', 'status' => 'required|string']);
        Facility::create($validated);
        return back()->with('success', 'Facility added successfully.');
    }

    public function updateFacility(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);
        $facility->update($request->validate(['name' => 'required|string', 'capacity' => 'required|integer', 'status' => 'required|string']));
        return back()->with('success', 'Facility updated successfully.');
    }

    public function deleteFacility($id)
    {
        Facility::findOrFail($id)->delete();
        return back()->with('success', 'Facility deleted.');
    }

    // Equipment CRUD
    public function storeEquipment(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string', 'quantity' => 'required|integer', 'category' => 'required|string', 'status' => 'required|string']);
        Equipment::create($validated);
        return back()->with('success', 'Equipment added successfully.');
    }

    public function updateEquipment(Request $request, $id)
    {
        $item = Equipment::findOrFail($id);
        $item->update($request->validate(['name' => 'required|string', 'quantity' => 'required|integer', 'category' => 'required|string', 'status' => 'required|string']));
        return back()->with('success', 'Equipment updated successfully.');
    }

    public function deleteEquipment($id)
    {
        Equipment::findOrFail($id)->delete();
        return back()->with('success', 'Equipment deleted.');
    }

    // User Management (Deactivate / Update Role)
    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        // Toggle role between student/faculty and inactive or toggle a status flag if you have one
        $user->update(['role' => $user->role === 'inactive' ? 'student' : 'inactive']);
        return back()->with('success', 'User status updated.');
    }
}