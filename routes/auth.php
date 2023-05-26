<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');
    // Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthController::class, 'showAuthPage'])->name('login');
    Route::post('login', [AuthController::class, 'getLogin']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard.index');
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'deleteProfile'])->name('profile.destroy');
    Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('logout', [AuthController::class, 'getLogout'])->name('logout');
});
