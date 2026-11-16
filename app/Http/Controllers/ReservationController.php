<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Display dashboard with user reservations
    public function index()
    {
        $reservations = Auth::user()->reservations()->latest()->get();
        return view('dashboard', compact('reservations'));
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
            'status' => 'pending', // Lowercase to match DB check constraint
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

    // ==================== ADMIN METHODS ====================

    // Display admin dashboard with all system reservations
    public function adminIndex()
    {
        $reservations = Reservation::latest()->get();
        return view('admin.dashboard', compact('reservations'));
    }

    // Approve a user reservation (Admin action)
    public function approve($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'approved']);

        return back()->with('success', 'Reservation approved successfully.');
    }

    // Reject/Cancel a user reservation (Admin action)
    public function reject($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => 'cancelled']);

        return back()->with('success', 'Reservation has been rejected.');
    }
}