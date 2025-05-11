<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\LotteryController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('auth.send-otp');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('auth.verify-otp');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    // Horoscope Routes
    Route::get('/horoscope', [HoroscopeController::class, 'index'])->name('horoscope.index');
    Route::post('/horoscope/purchase', [HoroscopeController::class, 'purchase'])->name('horoscope.purchase');
    
    // Lottery Routes
    Route::get('/lottery', [LotteryController::class, 'index'])->name('lottery.index');
    Route::get('/lottery/winners', [LotteryController::class, 'winners'])->name('lottery.winners');
});


