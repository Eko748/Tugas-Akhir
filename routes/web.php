<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'showHomePage'])->name('home');

Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('auth.google');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);


require __DIR__.'/auth.php';
require __DIR__ . '/leader.php ';
require __DIR__ . '/member.php';
