<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authenticated Routes (For all logged-in users)
Route::middleware('auth')->group(function () {
    // Student Dashboard Route
    Route::get('/dashboard', [ReservationController::class, 'studentDashboard'])->name('dashboard');

    // Reservation List & Management
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    
    // Cancellation Routes (Handles both /cancel and /status forms)
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::patch('/reservations/{reservation}/status', [ReservationController::class, 'cancel'])->name('reservations.status');

    // Notification Read Route
    Route::post('/notifications/read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.read');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Unified Admin Routes (Protected by auth and admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Reservations Management & Status Update
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('reservations.index');
    Route::get('/reservations/{reservation}', [AdminController::class, 'showReservation'])->name('reservations.show');
    Route::patch('/reservations/{reservation}', [AdminController::class, 'updateStatus'])->name('reservations.update-status');

    // Reports & PDF Export
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports.index');
    Route::get('/reports/pdf', [AdminController::class, 'exportPdf'])->name('reports.pdf');

    // Resource Management (Facilities)
    Route::get('/resources', [AdminController::class, 'resources'])->name('resources.index');
    Route::post('/facilities', [AdminController::class, 'storeFacility'])->name('facilities.store');
    Route::put('/facilities/{facility}', [AdminController::class, 'updateFacility'])->name('facilities.update');
    Route::delete('/facilities/{facility}', [AdminController::class, 'destroyFacility'])->name('facilities.destroy');

    // Resource Management (Equipment)
    Route::post('/equipment', [AdminController::class, 'storeEquipment'])->name('equipment.store');
    Route::put('/equipment/{equipment}', [AdminController::class, 'updateEquipment'])->name('equipment.update');
    Route::delete('/equipment/{equipment}', [AdminController::class, 'destroyEquipment'])->name('equipment.destroy');

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::patch('/users/{user}/status', [UserController::class, 'toggleStatus'])->name('users.status');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// --- Availability Checking Route ---
Route::get('/availability', [ReservationController::class, 'availability'])->name('reservations.availability');

require __DIR__.'/auth.php';