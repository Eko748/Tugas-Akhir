<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Management\ProductController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    Route::middleware(['2'])->group(function () {
        Route::get('/dashboard-member', [DashboardController::class, 'index'])->name('dashboard.member');
        Route::get('/member', [ProductController::class, 'member'])->name('dashboard');
    });
});