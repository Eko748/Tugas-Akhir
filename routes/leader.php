<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Management\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\Management\InstituteController;
use App\Http\Controllers\Management\MemberController;
use App\Http\Controllers\Management\ProjectController;
use App\Http\Controllers\Management\SLRController;
use App\Http\Controllers\Scraping\CategoryController;
use App\Http\Controllers\Scraping\ReviewController;
use App\Http\Controllers\Scraping\ScopusController;
use App\Http\Controllers\Scraping\ScrapingController;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

Route::middleware('auth')->group(function () {
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    Route::middleware(['2'])->group(function () {
        Route::get('/member', [ProductController::class, 'member'])->name('dashboard');
    });
    Route::middleware(['1', 'auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Management | Member
        Route::prefix("management")->group(function () {
            Route::controller(MemberController::class)->group(function () {
                Route::get('/member', 'index')->name('management.member.index');
                Route::get('/member-data', 'getTable')->name('management.member.table');
                Route::get('/member-list-data', 'getUser')->name('management.member.getUser');
                Route::post('/member-create', 'create')->name('management.member.create');
                Route::get('/member-edit', 'edit')->name('management.member.edit');
                Route::put('/member-update', 'update')->name('management.member.update');
                Route::post('/member-delete/{id}', 'delete')->name('management.member.delete');
                Route::get('/member-export', 'export')->name('management.member.export');
            });

            Route::controller(ProjectController::class)->group(function () {
                Route::get('/project', 'index')->name('management.project.index');
                Route::post('/project-create', 'create')->name('management.project.create');
                Route::get('/project-list-data', 'getProject')->name('management.project.getProject');
                Route::get('/project/{uuid_project}', 'detail')->name('management.project.detail');
                Route::get('/project-fetch-data/{uuid_project}', 'getTable')->name('management.project.getTable');
                Route::get('/project-export/{uuid_project}', 'export')->name('management.project.export');
            });

            Route::controller(SLRController::class)->group(function () {
                Route::get('/slr', 'index')->name('slr.index');
                Route::post('/slr-print', 'print')->name('slr.print');
                Route::get('/slr-fetch', 'getMoreProjects')->name('slr.get');

            });

            Route::controller(InstituteController::class)->group(function () {
                Route::post('/institute-create', 'create')->name('management.institute.create');
            });

            Route::controller(ScrapingController::class)->group(function () {
                Route::get('/scraping', 'index')->name('scraping.index');
                Route::get('/getScrap', 'getScraping')->name('scraping.get');
            });

            Route::controller(ScopusController::class)->group(function () {
                Route::get('/hehe', 'search')->name('hehe.index');
            });

            Route::controller(CategoryController::class)->group(function () {
                Route::post('/scraping-category-create', 'create')->name('scraping.category.create');
                Route::get('/scraping-list-data', 'getCategory')->name('scraping.category.getCategory');
            });

            Route::controller(ProductController::class)->group(function () {
                Route::get('/product', 'index')->name('management.product.index');
                Route::get('/product/fetch-data', 'getMoreUsers')->name('management.product.fetch');
                Route::get('/product/user-data', 'selectSearch')->name('management.product.selectSearch');
                Route::get('/product/search-data', 'search')->name('management.product.search');
            });
        });

        Route::prefix("scraping")->group(function () {
            Route::controller(ReviewController::class)->group(function () {
                Route::get('/review', 'index')->name('scraping.review.index');
                Route::get('/review/fetch-data', 'getData')->name('scraping.data.fetch');
                Route::post('/review/post-data', 'create')->name('scraping.review.create');
            });
        });

        Route::prefix("chat")->group(function () {
            Route::controller(MessageController::class)->group(function () {
                Route::get('/messages', 'index');
                Route::get('/ajax-message', 'getAjax')->name('message.ajax');
                Route::post('/send-message', 'store')->name('message.post');
            });
        });

        // Route::get('/export-users', function () {
        //     return Excel::download(new UsersExport, 'users.xlsx');
        // })->name('excel.users');
    });
});
