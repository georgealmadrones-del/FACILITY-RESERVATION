<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Equipment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class ReservationController extends Controller
{
    // Display dashboard with user reservations
    public function index()
    {
        // Automatically run migrations on Render if tables are missing
        if (!Schema::hasTable('reservations')) {
            try {
                Artisan::call('migrate', ['--force' => true]);
            } catch (\Throwable $e) {
                // Silently handle if database is still waking up
            }
        }

        $facilities = Facility::all();
        $equipment = Equipment::all();
        $reservations = auth()->user()->reservations()->latest()->get();
        
        // Fetch live database notifications for the logged-in user
        $notifications = auth()->user()->notifications()->latest()->take(10)->get();

        return view('dashboard', compact('facilities', 'equipment', 'reservations', 'notifications'));
    }

    // (Keep your other store/cancel/return methods below as they are)
}