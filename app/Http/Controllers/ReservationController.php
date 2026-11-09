<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Your index or other methods...

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

        auth()->user()->reservations()->create([
            'resource_type' => $validated['resource_type'],
            'resource_name' => $validated['resource_name'],
            'category' => $validated['category'],
            'purpose' => $validated['purpose'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'quantity' => $validated['quantity'],
            'status' => 'PENDING', // Default state for custodian approval
        ]);

        return redirect()->route('dashboard')->with('success', 'Reservation submitted successfully!');
    }
}

    // Cancel a reservation
    public function cancel($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if ($reservation->status === 'PENDING' || $reservation->status === 'APPROVED') {
            $reservation->update(['status' => 'CANCELLED']);
            return back()->with('success', 'Reservation has been cancelled.');
        }

        return back()->with('error', 'This reservation can no longer be cancelled.');
    }

    // Return borrowed unit/equipment
    public function returnUnit($id)
    {
        $reservation = Reservation::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        $reservation->update([
            'status' => 'RETURNED',
            'returned_at' => now(),
        ]);

        return back()->with('success', 'Unit successfully marked as returned and inventory stock restored.');
    }
}