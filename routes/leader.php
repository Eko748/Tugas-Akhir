<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Management\{InstituteController, MemberController, ProjectController,};
use App\Http\Controllers\Recycle\{RecycleMemberController, RecycleProjectController};
use App\Http\Controllers\Scraping\{ScrapingMasterController, IeeeController, AcmController, SpringerController};

Route::middleware('auth')->group(function () {
    // Login
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    // Leader Route
    Route::middleware(['1', 'auth'])->group(function () {
        // Management
        Route::prefix("management")->group(function () {
            // Member
            Route::prefix("member")->group(function () {
                Route::controller(MemberController::class)->group(function () {
                    Route::get('/', 'showMember')->name('management.member.index');
                    Route::get('/request', 'requestMember')->name('management.member.table');
                    Route::get('/search', 'searchMember')->name('management.member.getUser');
                    Route::post('/create', 'createMember')->name('management.member.create');
                    Route::get('/edit', 'editMember')->name('management.member.edit');
                    Route::put('/update', 'updateMember')->name('management.member.update');
                    Route::post('/password', 'setPasswordMember')->name('management.member.password');
                    Route::post('/delete', 'deleteMember')->name('management.member.delete');
                    Route::get('/export', 'exportMember')->name('management.member.export');
                });
            });
            // Project
            Route::prefix("project-scraping")->group(function () {
                Route::controller(ProjectController::class)->group(function () {
                    Route::get('/', 'showProjectScraping')->name('management.project.index');
                    Route::get('/request', 'requestProjectScraping')->name('management.project.getTable');
                    Route::get('/export', 'exportProjectScraping')->name('management.project.export');
                    Route::get('/snowballing', 'getSnowballScraping')->name('management.project.snowBalling');
                    Route::get('/detail', 'getDetailScraping')->name('management.project.modalDetail');
                    Route::post('/delete', 'deleteProjectScraping')->name('management.projectSLR.delete');
                });
            });
            Route::controller(InstituteController::class)->group(function () {
                Route::post('/institute-create', 'createInstitute')->name('management.institute.create');
            });
        });
        // Review
        Route::prefix("scraping")->group(function () {
            // Master
            Route::controller(ScrapingMasterController::class)->group(function () {
                Route::get('/', 'showScraping')->name('review.master.index');
                Route::post('/post-data', 'createScraping')->name('review.master.create');
            });
            // IEEE
            Route::controller(IeeeController::class)->group(function () {
                Route::get('/article-ieee', 'showScrapingData')->name('review.ieee.index');
                Route::get('/article-ieee-request', 'requestScrapingData')->name('review.ieee.request');
            });
            // ACM
            Route::controller(AcmController::class)->group(function () {
                Route::get('/acm', 'showScrapingData')->name('review.acm.index');
                Route::get('/acm-request', 'requestScrapingData')->name('review.acm.request');
            });
            // Springer
            Route::controller(SpringerController::class)->group(function () {
                Route::get('/springer', 'showScrapingData')->name('review.springer.index');
                Route::get('/springer-request', 'requestScrapingData')->name('review.springer.request');
            });
        });
        // Recycle
        Route::prefix("recycle")->group(function () {
            Route::prefix("member")->group(function () {
                Route::controller(RecycleMemberController::class)->group(function () {
                    Route::get('/', 'showRecycleData')->name('recycle.member');
                    Route::get('/request', 'requestRecycleData')->name('recycle.member.request');
                    Route::post('/restore', 'restoreRecycleData')->name('recycle.member.restore');
                    Route::post('/delete', 'deleteRecycleData')->name('recycle.member.delete');
                });
            });
            Route::prefix("project")->group(function () {
                Route::controller(RecycleProjectController::class)->group(function () {
                    Route::get('/', 'showRecycleData')->name('recycle.project');
                    Route::get('/request', 'requestRecycleData')->name('recycle.project.request');
                    Route::post('/restore', 'restoreRecycleData')->name('recycle.project.restore');
                    Route::post('/delete', 'deleteRecycleData')->name('recycle.project.delete');
                });
            });
        });
    });
});
