<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public homepage
Route::get('/', function () {
    $featuredEvents = \App\Models\Event::published()->upcoming()->featured()
        ->orderBy('start_date')
        ->take(3)
        ->get();
    $upcomingEvents = \App\Models\Event::published()->upcoming()
        ->orderBy('start_date')
        ->take(6)
        ->get();
    return view('home', compact('featuredEvents', 'upcomingEvents'));
})->name('home');

// Auth (guests only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Profile (authenticated users)
Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('show');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password');
});

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');

// Bookings
Route::post('/events/{event:slug}/book', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/booking/{reference}', [BookingController::class, 'confirmation'])->name('bookings.confirmation');
Route::post('/booking/{reference}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
Route::get('/my-booking', [BookingController::class, 'lookup'])->name('bookings.lookup');
Route::post('/my-booking', [BookingController::class, 'find'])->name('bookings.find');

// Admin (staff only)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'staff'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/events', [AdminController::class, 'events'])->name('events');
    Route::get('/events/{event}/bookings', [AdminController::class, 'eventBookings'])->name('event-bookings');
});
