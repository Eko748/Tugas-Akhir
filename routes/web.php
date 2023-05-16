<?php

use App\Http\Controllers\Auth\SocialAccountController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Review\AcmController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'showHomePage'])->name('home');
Route::get('/demo', [AcmController::class, 'requestReviewData'])->name('home.demo');

Route::get('/auth/{provider}', [SocialAccountController::class, 'redirectToProvider'])->name('auth.google');
Route::get('/auth/{provider}/callback', [SocialAccountController::class, 'handleProvideCallback']);

require __DIR__.'/auth.php';
require __DIR__.'/leader.php';
require __DIR__.'/member.php';

