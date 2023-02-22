<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Management\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\MessageController;
use App\Http\Controllers\Management\InstituteController;
use App\Http\Controllers\Management\MemberController;
use App\Http\Controllers\Management\ProjectController;
use App\Http\Controllers\Scraping\CategoryController;
use App\Http\Controllers\Scraping\ReviewController;
use App\Http\Controllers\Scraping\ScopusController;
use App\Http\Controllers\Scraping\ScrapingController;
use App\Http\Controllers\Scraping\TemplateController;

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
                Route::get('/member-data-user', 'getUser')->name('management.member.getUsers');
                Route::post('/member-create', 'create')->name('management.member.create');
                Route::get('/member-edit', 'edit')->name('management.member.edit');
                Route::put('/member-update', 'update')->name('management.member.update');
                Route::post('/member-delete/{id}', 'delete')->name('management.member.delete');
            });

            Route::controller(ProjectController::class)->group(function () {
                Route::get('/project', 'index')->name('management.project.index');
                Route::post('/project-create', 'create')->name('management.project.create');
                // Route::get('/project-data', 'getTable')->name('management.project.table');
                // Route::get('/project-data-user', 'getUser')->name('management.project.getUsers');
                // Route::get('/project-edit', 'edit')->name('management.project.edit');
                // Route::put('/project-update', 'update')->name('management.project.update');
                // Route::post('/project-delete/{id}', 'delete')->name('management.project.delete');
            });

            Route::controller(InstituteController::class)->group(function () {
                Route::post('/institute-create', 'create')->name('management.institute.create');
            });

            Route::controller(ScrapingController::class)->group(function () {
                Route::get('/scraping', 'index')->name('scraping.index');
            });

            Route::controller(ScopusController::class)->group(function () {
                Route::get('/hehe', 'search')->name('hehe.index');
            });

            Route::controller(CategoryController::class)->group(function () {
                Route::post('/scraping-category-create', 'create')->name('scraping.category.create');
            });

            Route::controller(TemplateController::class)->group(function () {
                Route::post('/scraping-template-create', 'create')->name('scraping.template.create');
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
            });
        });

        Route::prefix("chat")->group(function () {
            Route::controller(MessageController::class)->group(function () {
                Route::get('/messages', 'index');
                Route::get('/ajax-message', 'getAjax')->name('message.ajax');
                Route::post('/send-message', 'store')->name('message.post');
            });
        });
    });
});
