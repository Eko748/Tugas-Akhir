<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Management\ProductController;
use App\Http\Controllers\Management\ProjectController;
use App\Http\Controllers\Scraping\CategoryController;
use App\Http\Controllers\Scraping\ReviewController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    Route::middleware(['2'])->group(function () {
        Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.member');
        Route::get('/member', [ProductController::class, 'member'])->name('dashboard');

        Route::prefix("project")->group(function () {
            Route::controller(ProjectController::class)->group(function () {
                Route::get('/master', 'index')->name('project.index');
                Route::get('/{uuid_project}', 'detail')->name('project.detail');
                Route::get('/list-data', 'getProject')->name('project.getProject');
                Route::get('/fetch-data/{uuid_project}', 'getTable')->name('project.getTable');
                Route::get('/export/{uuid_project}', 'export')->name('project.export');
            });
        });

        Route::prefix("category")->group(function () {
            Route::controller(CategoryController::class)->group(function () {
                Route::get('/category-data', 'getCategory')->name('category.getCategory');
            });
        });

        Route::prefix("review")->group(function () {
            Route::controller(ReviewController::class)->group(function () {
                Route::get('/ieee', 'index')->name('review.index');
                Route::get('/ieee/fetch-data', 'getData')->name('data.fetch');
                Route::post('/ieee/post-data', 'create')->name('review.create');
            });
        });
    });
});
