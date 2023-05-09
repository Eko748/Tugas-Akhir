<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Exception\PageHandlingController;
use App\Http\Controllers\Management\ProductController;
use App\Http\Controllers\Management\ProjectController;
use App\Http\Controllers\Management\ProjectSLRController;
use App\Http\Controllers\Management\SLRController;
use App\Http\Controllers\Review\AcmController;
use App\Http\Controllers\Review\CiteSeerxController;
use App\Http\Controllers\Review\IeeeController;
use App\Http\Controllers\Review\ReviewMasterController;
use App\Http\Controllers\Review\ScienceDirectController;
use App\Http\Controllers\Review\SpringerController;
use App\Http\Controllers\Scraping\CategoryController;
use App\Http\Controllers\Scraping\ReviewController;
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
                    Route::get('/', 'showProject')->name('project.index');
                    Route::get('/project-request', 'requestReviewData')->name('project.getTable');
                    Route::get('/project-export', 'exportProjectData')->name('project.export');
                    Route::get('/snowballing', 'showModalSnowballing')->name('project.snowBalling');
                    Route::get('/detail', 'showModalDetail')->name('project.modalDetail');
                    Route::post('/delete', 'deleteProjectSLR')->name('projectSLR.delete');
                });
            });

            Route::prefix("review")->group(function () {
                // Master
                Route::controller(ReviewMasterController::class)->group(function () {
                    Route::get('/', 'showReview')->name('master.index');
                    Route::post('/post-data', 'createReview')->name('master.create');
                    Route::post('/category-post', 'createCategory')->name('category.create');
                    Route::get('/list-category', 'getCategory')->name('category.get');
                    Route::get('/list-project', 'getProject')->name('project.getProject');
                    Route::get('/list-project-detail', 'getProjectDetail')->name('project.getProjectDetail');
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
        Route::fallback([PageHandlingController::class, 'showPage404']);
    });
});
