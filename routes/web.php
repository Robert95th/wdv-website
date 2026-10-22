<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstateMatterController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/services', function () { return view('services'); })->name('services');
Route::get('/meetings', [EstateMatterController::class, 'index'])->name('meetings.index');
Route::get('/archived', [EstateMatterController::class, 'archived'])->name('matters.archived');
Route::get('/properties', [App\Http\Controllers\PropertyListingController::class, 'index'])->name('properties.index');

Route::post('/request-service', [ServiceRequestController::class, 'store'])->middleware('throttle:3,1')->name('service.request');
Route::post('/subscribe', [SubscriberController::class, 'store'])->middleware('throttle:3,1')->name('newsletter.subscribe');

Route::view('/privacy-policy', 'legal.privacy')->name('privacy');
Route::view('/terms-of-service', 'legal.terms')->name('terms');


// ==========================================
// CUSTOM AUTHENTICATION (cmp/sign-in)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('cmp/sign-in', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('cmp/sign-in', [AuthenticatedSessionController::class, 'store']);
});


// ==========================================
// PROTECTED ADMIN ROUTES (cmp)
// ==========================================
Route::middleware(['auth'])->prefix('cmp')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Meetings
    Route::get('meetings', [MeetingController::class, 'index'])->name('meetings.index');
    Route::post('meetings', [MeetingController::class, 'store'])->name('meetings.store');
    Route::put('meetings/{meeting}', [MeetingController::class, 'update'])->name('meetings.update');
    Route::delete('meetings/{meeting}', [MeetingController::class, 'destroy'])->name('meetings.destroy');

    // Properties
    Route::get('properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::post('properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::put('properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
});


// ==========================================
// LOGOUT
// ==========================================
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// ==========================================
// BREEZE AUTH ROUTES (Forgot Password, Reset Password, etc.)
// ==========================================
require __DIR__ . '/auth.php';