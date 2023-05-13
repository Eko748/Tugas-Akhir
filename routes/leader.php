<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Auth\AuthController, Dashboard\DashboardController, Exception\PageHandlingController};
use App\Http\Controllers\Management\{InstituteController, MemberController, ProjectController,};
use App\Http\Controllers\Recycle\{RecycleMemberController, RecycleProjectController};
use App\Http\Controllers\Review\{ReviewMasterController, IeeeController, AcmController, SpringerController,};

Route::middleware('auth')->group(function () {
    // Login
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    // Leader Route
    Route::middleware(['1', 'auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard.index');
        // Management
        Route::prefix("management")->group(function () {
            // Member
            Route::prefix("member")->group(function () {
                Route::controller(MemberController::class)->group(function () {
                    Route::get('/', 'showMember')->name('management.member.index');
                    Route::get('/data', 'requestMemberData')->name('management.member.table');
                    Route::get('/search', 'searchMemberData')->name('management.member.getUser');
                    Route::post('/create', 'createMember')->name('management.member.create');
                    Route::get('/edit', 'editMember')->name('management.member.edit');
                    Route::put('/update', 'updateMember')->name('management.member.update');
                    Route::post('/delete', 'deleteMember')->name('management.member.delete');
                    Route::get('/export', 'exportMemberData')->name('management.member.export');
                });
            });
            // Project
            Route::prefix("project")->group(function () {
                Route::controller(ProjectController::class)->group(function () {
                    Route::get('/', 'showProjectReview')->name('management.project.index');
                    Route::get('/request', 'requestProjectReviewData')->name('management.project.getTable');
                    Route::get('/export', 'exportProjectReviewData')->name('management.project.export');
                    Route::get('/snowballing', 'getProjectReviewSnowballing')->name('management.project.snowBalling');
                    Route::get('/detail', 'getProjectReviewDetail')->name('management.project.modalDetail');
                    Route::post('/delete', 'deleteProjectReviewData')->name('management.projectSLR.delete');
                });
            });
            Route::controller(InstituteController::class)->group(function () {
                Route::post('/institute-create', 'createInstituteData')->name('management.institute.create');
            });
        });
        // Review
        Route::prefix("review")->group(function () {
            // Master
            Route::controller(ReviewMasterController::class)->group(function () {
                Route::get('/', 'showReview')->name('review.master.index');
                Route::post('/post-data', 'createReview')->name('review.master.create');
            });
            // IEEE
            Route::controller(IeeeController::class)->group(function () {
                Route::get('/article-ieee', 'showReviewData')->name('review.ieee.index');
                Route::get('/article-ieee-request', 'requestReviewData')->name('review.ieee.request');
            });
            // ACM
            Route::controller(AcmController::class)->group(function () {
                Route::get('/acm', 'showReviewData')->name('review.acm.index');
                Route::get('/acm-request', 'requestReviewData')->name('review.acm.request');
            });
            // Springer
            Route::controller(SpringerController::class)->group(function () {
                Route::get('/springer', 'showReviewData')->name('review.springer.index');
                Route::get('/springer-request', 'requestReviewData')->name('review.springer.request');
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
        // To do
    });

    // Route::fallback([PageHandlingController::class, 'showPage404']);
});
