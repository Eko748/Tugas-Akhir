<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Management\ProjectController;
use App\Http\Controllers\Scraping\{ScrapingMasterController, IeeeController, AcmController, SpringerController};
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    // Member
    Route::middleware(['2', 'auth'])->group(function () {
        Route::prefix("m")->group(function () {
            // Dashboard
            // Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard.member');
            // Project
            Route::prefix("project-scraping")->group(function () {
                Route::controller(ProjectController::class)->group(function () {
                    Route::get('/', 'showProjectScraping')->name('project.index');
                    Route::get('/request', 'requestProjectScraping')->name('project.getTable');
                    Route::get('/export', 'exportProjectScraping')->name('project.export');
                    Route::get('/snowballing', 'getSnowballScraping')->name('project.snowBalling');
                    Route::get('/detail', 'getDetailScraping')->name('project.modalDetail');
                    Route::post('/delete', 'deleteProjectScraping')->name('projectSLR.delete');
                });
            });
            // Master
            Route::prefix("scraping")->group(function () {
                // Master
                Route::controller(ScrapingMasterController::class)->group(function () {
                    Route::get('/', 'showScraping')->name('master.index');
                    Route::post('/post-data', 'createScraping')->name('master.create');
                });
                // IEEE
                Route::controller(IeeeController::class)->group(function () {
                    Route::get('/article-ieee', 'showScrapingData')->name('ieee.index');
                    Route::get('/article-ieee-request', 'requestScrapingData')->name('ieee.request');
                });
                // ACM
                Route::controller(AcmController::class)->group(function () {
                    Route::get('/acm', 'showScrapingData')->name('acm.index');
                    Route::get('/acm-request', 'requestScrapingData')->name('acm.request');
                });
                // Springer
                Route::controller(SpringerController::class)->group(function () {
                    Route::get('/springer', 'showScrapingData')->name('springer.index');
                    Route::get('/springer-request', 'requestScrapingData')->name('springer.request');
                });
            });
        });
        // Route::fallback([PageHandlingController::class, 'showPage404']);
    });
});
