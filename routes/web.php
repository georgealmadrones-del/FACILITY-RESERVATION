<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // User Routes
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::post('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::post('/reservations/{id}/return', [ReservationController::class, 'returnUnit'])->name('reservations.return');

    Route::get('/availability', function () {
        return view('dashboard');
    })->name('availability');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Database-Driven Routes (Handled by AdminController)
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/reservations/{reservation}/approve', [AdminController::class, 'approveReservation'])->name('admin.reservations.approve');
    Route::post('/admin/reservations/{reservation}/reject', [AdminController::class, 'rejectReservation'])->name('admin.reservations.reject');

    // Facility Management
    Route::post('/admin/facilities', [AdminController::class, 'storeFacility'])->name('admin.facilities.store');
    Route::put('/admin/facilities/{facility}', [AdminController::class, 'updateFacility'])->name('admin.facilities.update');
    Route::delete('/admin/facilities/{facility}', [AdminController::class, 'destroyFacility'])->name('admin.facilities.destroy');

    // Equipment Management
    Route::post('/admin/equipment', [AdminController::class, 'storeEquipment'])->name('admin.equipment.store');
    Route::put('/admin/equipment/{equipment}', [AdminController::class, 'updateEquipment'])->name('admin.equipment.update');
    Route::delete('/admin/equipment/{equipment}', [AdminController::class, 'destroyEquipment'])->name('admin.equipment.destroy');

    // User Management (Deactivate / Reactivate)
    Route::post('/admin/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('admin.users.toggle');

    // Reports & PDF Export
    Route::get('/admin/reports/pdf', [AdminController::class, 'exportPdf'])->name('admin.reports.pdf');
});

require __DIR__.'/auth.php';