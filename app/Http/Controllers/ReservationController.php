<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Load Dashboard with real user data & reservations
    public function index()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('reservations'));
    }

    // Store a new reservation request
    public function store(Request $request)
    {
        $request->validate([
            'resource_name' => 'required|string',
            'resource_type' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'purpose' => 'required|string',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'resource_name' => $request->resource_name,
            'resource_type' => $request->resource_type,
            'category' => $request->category ?? 'rooms',
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'quantity_or_attendees' => $request->quantity ?? 1,
            'purpose' => $request->purpose,
            'status' => 'PENDING',
        ]);

        return redirect()->route('dashboard')->with('success', 'Reservation request submitted successfully!');
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