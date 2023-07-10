<?php

use App\Http\Controllers\Auth\SocialAccountController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Scraping\IeeeController;
use App\Http\Controllers\Scraping\SpringerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'showHomePage'])->name('home');
Route::get('/demo', [SpringerController::class, 'requestScrapingData'])->name('home.demo');

Route::get('/auth/{provider}', [SocialAccountController::class, 'redirectToProvider'])->name('auth.google');
Route::get('/auth/{provider}/callback', [SocialAccountController::class, 'handleProvideCallback']);

require __DIR__.'/auth.php';
require __DIR__.'/leader.php';
require __DIR__.'/member.php';

