<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    Auth\AuthController,
    Dashboard\DashboardController,
    Exception\PageHandlingController
};
use App\Http\Controllers\Management\{
    InstituteController, MemberController, ProjectController, ProjectSLRController
};
use App\Http\Controllers\Recycle\RecycleMemberController;
use App\Http\Controllers\Recycle\RecycleProjectController;
use App\Http\Controllers\Review\{
    IeeeController, AcmController, CiteSeerxController, ReviewMasterController, 
    ScienceDirectController, SpringerController
};

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
                Route::get('/member', 'showMember')->name('management.member.index');
                Route::get('/member-data', 'requestMemberData')->name('management.member.table');
                Route::get('/member-search', 'searchMemberData')->name('management.member.getUser');
                Route::post('/member-create', 'createMember')->name('management.member.create');
                Route::get('/member-edit', 'editMember')->name('management.member.edit');
                Route::put('/member-update', 'updateMember')->name('management.member.update');
                Route::post('/member-delete/{id}', 'deleteMember')->name('management.member.delete');
                Route::get('/member-export', 'exportMemberData')->name('management.member.export');
            });
            // Project
            Route::prefix("project")->group(function () {
                Route::controller(ProjectController::class)->group(function () {
                    Route::get('/', 'showProject')->name('management.project.index');
                    Route::get('/request', 'requestProjectData')->name('management.project.request');
                    Route::post('/create', 'createProject')->name('management.project.create');
                });
                Route::controller(ProjectSLRController::class)->group(function () {
                    Route::get('/{uuid_project}', 'showProjectDetail')->name('management.project.detail');
                    Route::get('/fetch/{uuid_project}', 'getProjectDetailData')->name('management.project.getTable');
                    Route::get('/export/{uuid_project}', 'exportProjectData')->name('management.project.export');
                    Route::get('/snowballing/{uuid_project}', 'showModalSnowballing')->name('management.project.snowBalling');
                    Route::get('/detail/{uuid_project}', 'showModalDetail')->name('management.project.modalDetail');
                    Route::post('/delete', 'deleteProjectSLR')->name('management.projectSLR.delete');
                });
            });
            Route::controller(InstituteController::class)->group(function () {
                Route::post('/institute-create', 'create')->name('management.institute.create');
            });
        });
        // Review
        Route::prefix("review")->group(function () {
            // Master
            Route::controller(ReviewMasterController::class)->group(function () {
                Route::get('/', 'showReview')->name('review.master.index');
                Route::post('/post-data', 'createReview')->name('review.master.create');
                Route::post('/category-post', 'createCategory')->name('review.category.create');
                Route::get('/list-category', 'getCategory')->name('review.category.get');
                Route::get('/list-project', 'getProject')->name('review.project.getProject');
                Route::get('/list-project-detail', 'getProjectDetail')->name('review.project.getProjectDetail');
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
            // ScienceDirect
            Route::controller(ScienceDirectController::class)->group(function () {
                Route::get('/sciencedirect', 'showReviewScienceDirect')->name('review.sciencedirect.index');
                Route::get('/sciencedirect-request', 'requestScienceDirectData')->name('review.sciencedirect.request');
            });
            // CiteSeerx
            Route::controller(CiteSeerxController::class)->group(function () {
                Route::get('/citeseerx', 'showReviewCiteSeerx')->name('review.citeseerx.index');
            });
        });
        // Recycle
        Route::prefix("recycle")->group(function () {
            Route::controller(RecycleMemberController::class)->group(function () {
                Route::get('/member', 'showRecycleData')->name('recycle.member');
                Route::get('/member-request', 'requestRecycleData')->name('recycle.member.request');
            });
            Route::controller(RecycleProjectController::class)->group(function () {
                Route::get('/project', 'showRecycleData')->name('recycle.project');
                Route::get('/project-request', 'requestRecycleData')->name('recycle.project.request');
            });
        });
        // To do
    });

    // Route::fallback([PageHandlingController::class, 'showPage404']);
});
