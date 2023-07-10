<?php

use App\Http\Controllers\{Auth\AuthController, Exception\PageHandlingController};
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showAuthPage'])->name('login');
    Route::post('login', [AuthController::class, 'getLogin']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'deleteProfile'])->name('profile.destroy');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::put('/institute', [ProfileController::class, 'updateInstitute'])->name('institute.update');
    Route::post('logout', [AuthController::class, 'getLogout'])->name('logout');
    Route::fallback([PageHandlingController::class, 'showPage404']);
});
