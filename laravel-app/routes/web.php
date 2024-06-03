<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\DeanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});

Route::middleware(['auth', 'role:dean'])->group(function () {
    Route::get('/dean/appointments', [DeanController::class, 'index'])->name('dean.appointments.index');
    Route::get('/dean/appointments/filter', [DeanController::class, 'filter'])->name('dean.appointments.filter');
});

Route::middleware(['auth', 'role:coordinator'])->group(function () {
    Route::get('/coordinator/appointments', [CoordinatorController::class, 'index'])->name('coordinator.appointments.index');
    Route::post('/coordinator/appointments/update-multiple', [CoordinatorController::class, 'updateMultiple'])->name('coordinator.appointments.updateMultiple');
});

Route::middleware(['auth', 'role.redirect'])->get('/', function () {
    // This middleware will handle redirection based on user role
});


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/api/dean/{dean}/available-slots', [ApiController::class, 'getAvailableSlots']);
