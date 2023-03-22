<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Management\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\Exception\PageHandlingController;
use App\Http\Controllers\Management\InstituteController;
use App\Http\Controllers\Management\MemberController;
use App\Http\Controllers\Management\ProjectController;
use App\Http\Controllers\Review\IeeeController;
use App\Http\Controllers\Review\AcmController;
use App\Http\Controllers\Review\CiteSeerxController;
use App\Http\Controllers\Review\ReviewMasterController;
use App\Http\Controllers\Review\ScienceDirectController;
use App\Http\Controllers\Review\SpringerController;
use Illuminate\Support\Facades\Auth;

Route::middleware('auth')->group(function () {
    // Login
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    // Leader Route
    Route::middleware(['1', 'auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        // Management
        Route::prefix("management")->group(function () {
            // Member
            Route::controller(MemberController::class)->group(function () {
                Route::get('/member', 'getView')->name('management.member.index');
                Route::get('/member-data', 'getMemberData')->name('management.member.table');
                Route::get('/member-list-data', 'getUser')->name('management.member.getUser');
                Route::post('/member-create', 'createMember')->name('management.member.create');
                Route::get('/member-edit', 'editMember')->name('management.member.edit');
                Route::put('/member-update', 'updateMember')->name('management.member.update');
                Route::post('/member-delete/{id}', 'deleteMember')->name('management.member.delete');
                Route::get('/member-export', 'exportMemberData')->name('management.member.export');
            });
            // Project
            Route::controller(ProjectController::class)->group(function () {
                Route::get('/project', 'getView')->name('management.project.index');
                Route::post('/project-create', 'createProject')->name('management.project.create');
                Route::get('/project-list-data', 'getProject')->name('management.project.getProject');
                Route::get('/project/{uuid_project}', 'getProjectDetail')->name('management.project.detail');
                Route::get('/project-fetch-data/{uuid_project}', 'getProjectData')->name('management.project.getTable');
                Route::get('/project-export/{uuid_project}', 'exportProjectData')->name('management.project.export');
            });
            Route::controller(InstituteController::class)->group(function () {
                Route::post('/institute-create', 'create')->name('management.institute.create');
            });
        });
        // Review
        Route::prefix("review")->group(function () {
            // Master
            Route::controller(ReviewMasterController::class)->group(function () {
                Route::get('/master', 'getView')->name('review.master.index');
                Route::post('/post-data', 'createReview')->name('review.master.create');
                Route::post('/category-post', 'createCategory')->name('review.category.create');
                Route::get('/list-category', 'getCategory')->name('review.category.get');
            });
            // IEEE
            Route::controller(IeeeController::class)->group(function () {
                Route::get('/article-ieee', 'reviewIeee')->name('review.ieee.index');
            });
            // ScienceDirect
            Route::controller(ScienceDirectController::class)->group(function () {
                Route::get('/sciencedirect', 'reviewScienceDirect')->name('review.sciencedirect.index');
            });
            // Springer
            Route::controller(SpringerController::class)->group(function () {
                Route::get('/springer', 'reviewSpringer')->name('review.springer.index');
            });
            // ACM
            Route::controller(AcmController::class)->group(function () {
                Route::get('/acm', 'reviewAcm')->name('review.acm.index');
            });
            // CiteSeerx
            Route::controller(CiteSeerxController::class)->group(function () {
                Route::get('/citeseerx', 'reviewCiteSeerx')->name('review.citeseerx.index');
            });
        });
        // To do
        Route::prefix("chat")->group(function () {
            Route::controller(MessageController::class)->group(function () {
                Route::get('/messages', 'index');
                Route::get('/ajax-message', 'getAjax')->name('message.ajax');
                Route::post('/send-message', 'store')->name('message.post');
            });
        });
    });

    Route::fallback([PageHandlingController::class, 'showPage404']);
});
