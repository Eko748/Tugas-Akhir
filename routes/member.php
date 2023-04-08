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
    Route::middleware(['2', 'auth'])->group(function () {
        Route::prefix("member")->group(function () {
            Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.member');
            Route::get('/member', [ProductController::class, 'member'])->name('dashboard');

            Route::prefix("project")->group(function () {
                Route::controller(ProjectController::class)->group(function () {
                    Route::get('/index', 'showProject')->name('project.index');
                    Route::get('/request', 'requestProjectData')->name('project.request');
                    Route::post('/create', 'createProject')->name('project.create');
                });
                Route::controller(ProjectSLRController::class)->group(function () {
                    Route::get('/{uuid_project}', 'showProjectDetail')->name('project.detail');
                    Route::get('/fetch/{uuid_project}', 'getProjectDetailData')->name('project.getTable');
                    Route::get('/export/{uuid_project}', 'exportProjectData')->name('project.export');
                    Route::get('/snowballing/{uuid_project}', 'showModalSnowballing')->name('project.snowBalling');
                    Route::get('/detail/{uuid_project}', 'showModalDetail')->name('project.modalDetail');
                    Route::post('/delete', 'deleteProjectSLR')->name('projectSLR.delete');
                });
            });

            Route::prefix("review")->group(function () {
                // Master
                Route::controller(ReviewMasterController::class)->group(function () {
                    Route::get('/master', 'showReview')->name('master.index');
                    Route::post('/post-data', 'createReview')->name('master.create');
                    Route::post('/category-post', 'createCategory')->name('category.create');
                    Route::get('/list-category', 'getCategory')->name('category.get');
                    Route::get('/list-project', 'getProject')->name('project.getProject');
                    Route::get('/list-project-detail', 'getProjectDetail')->name('project.getProjectDetail');
                });
                // IEEE
                Route::controller(IeeeController::class)->group(function () {
                    Route::get('/article-ieee', 'reviewIeee')->name('ieee.index');
                    Route::get('/article-ieee-request', 'requestIeeeData')->name('ieee.request');
                });
                // ScienceDirect
                Route::controller(ScienceDirectController::class)->group(function () {
                    Route::get('/sciencedirect', 'reviewScienceDirect')->name('sciencedirect.index');
                });
                // Springer
                Route::controller(SpringerController::class)->group(function () {
                    Route::get('/springer', 'showReviewSpringer')->name('springer.index');
                    Route::get('/springer-request', 'requestSpringerData')->name('springer.request');
                });
                // ACM
                Route::controller(AcmController::class)->group(function () {
                    Route::get('/acm', 'reviewAcm')->name('acm.index');
                });
                // CiteSeerx
                Route::controller(CiteSeerxController::class)->group(function () {
                    Route::get('/citeseerx', 'reviewCiteSeerx')->name('citeseerx.index');
                });
            });
        });
        Route::fallback([PageHandlingController::class, 'showPage404']);
    });
});
