<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Management\ProjectController;
use App\Http\Controllers\Review\AcmController;
use App\Http\Controllers\Review\IeeeController;
use App\Http\Controllers\Review\ReviewMasterController;
use App\Http\Controllers\Review\SpringerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    // Member
    Route::middleware(['2', 'auth'])->group(function () {
        Route::prefix("m")->group(function () {
            // Dashboard
            Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard.member');
            // Project
            Route::prefix("project")->group(function () {
                Route::controller(ProjectController::class)->group(function () {
                    Route::get('/', 'showProjectReview')->name('project.index');
                    Route::get('/request', 'requestProjectReview')->name('project.getTable');
                    Route::get('/export', 'exportProjectReview')->name('project.export');
                    Route::get('/snowballing', 'getReviewSnowballing')->name('project.snowBalling');
                    Route::get('/detail', 'getReviewDetail')->name('project.modalDetail');
                    Route::post('/delete', 'deleteProjectReview')->name('projectSLR.delete');
                });
            });
            // Master
            Route::prefix("review")->group(function () {
                Route::controller(ReviewMasterController::class)->group(function () {
                    Route::get('/', 'showReview')->name('master.index');
                    Route::post('/post-data', 'createReview')->name('master.create');
                });
                // IEEE
                Route::controller(IeeeController::class)->group(function () {
                    Route::get('/article-ieee', 'showReviewData')->name('ieee.index');
                    Route::get('/article-ieee-request', 'requestReviewData')->name('ieee.request');
                });
                // ACM
                Route::controller(AcmController::class)->group(function () {
                    Route::get('/acm', 'showReviewData')->name('acm.index');
                    Route::get('/acm-request', 'requestReviewData')->name('acm.request');
                });
                // Springer
                Route::controller(SpringerController::class)->group(function () {
                    Route::get('/springer', 'showReviewData')->name('springer.index');
                    Route::get('/springer-request', 'requestReviewData')->name('springer.request');
                });
            });
        });
        // Route::fallback([PageHandlingController::class, 'showPage404']);
    });
});
