<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Equipment;

class ReservationController extends Controller
{
    // Display dashboard with user reservations
    public function index()
    {
        $facilities = Facility::all();
        $equipment = Equipment::all();
        $reservations = auth()->user()->reservations()->latest()->get();
        
        // Fetch live database notifications for the logged-in user
        $notifications = auth()->user()->notifications()->latest()->take(10)->get();

        return view('dashboard', compact('facilities', 'equipment', 'reservations', 'notifications'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'resource_type' => 'required|string',
        'resource_name' => 'required|string',
        'category'      => 'required|string',
        'start_time'    => 'required|string',
        'end_time'      => 'required|string',
        'quantity'      => 'required|integer|min:1',
        'purpose'       => 'required|string|max:255',
    ]);

    // Create the reservation linked to the authenticated user
    $request->user()->reservations()->create($validated);

    return redirect()->route('dashboard')->with('success', 'Reservation submitted successfully!');
}
    // Cancel a reservation
    public function cancel($id)
    {
        $reservation = auth()->user()->reservations()->findOrFail($id);
        $reservation->update(['status' => 'cancelled']);

        return redirect()->route('dashboard')->with('success', 'Reservation cancelled.');
    }

    // Return borrowed equipment/unit
    public function returnUnit($id)
    {
        $reservation = auth()->user()->reservations()->findOrFail($id);
        $reservation->update(['status' => 'returned']);

        return redirect()->route('dashboard')->with('success', 'Unit returned successfully.');
    }
}