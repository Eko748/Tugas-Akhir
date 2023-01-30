<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Management\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Management\InstituteController;
use App\Http\Controllers\Management\MemberController;
use App\Http\Controllers\Scraping\ScrapingController;

Route::middleware('auth')->group(function () {
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    Route::middleware(['1'])->group(function () {
        // Dashboard
        Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard.index');

        // Management | Employee
        Route::prefix("management")->group(function() {
            Route::controller(MemberController::class)->group(function() {
                Route::get('/member', 'index')->name('management.member.index');
                Route::get('/member-data', 'getTable')->name('management.member.table');
                Route::get('/member-data-user', 'getUser')->name('management.member.getUsers');
                Route::post('/member-create', 'create')->name('management.member.create');
                Route::get('/member-edit', 'edit')->name('management.member.edit');
                Route::put('/member-update', 'update')->name('management.member.update');
                Route::post('/member-delete/{id}', 'delete')->name('management.member.delete');
            });

            Route::controller(InstituteController::class)->group(function() {
                Route::post('/institute-create', 'create')->name('management.institute.create');
            });

            Route::controller(ScrapingController::class)->group(function() {
                Route::get('/scraping', 'index')->name('scraping.index');
            });

            Route::controller(ProductController::class)->group(function() {
                Route::get('/product', 'index')->name('management.product.index');
                Route::get('/product/fetch-data', 'getMoreUsers')->name('management.product.fetch');
                Route::get('/product/user-data', 'selectSearch')->name('management.product.selectSearch');
                Route::get('/product/search-data', 'search')->name('management.product.search');
            });
        });
    });
});