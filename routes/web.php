<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HoroscopeController;
use App\Http\Controllers\LotteryController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/horoscope', [HoroscopeController::class, 'index'])->name('horoscope.index');
    Route::post('/horoscope/purchase', [HoroscopeController::class, 'purchase'])->name('horoscope.purchase');
    Route::get('/lottery', [LotteryController::class, 'index'])->name('lottery.index');
    Route::get('/lottery/winners', [LotteryController::class, 'winners'])->name('lottery.winners');
});

Auth::routes();

