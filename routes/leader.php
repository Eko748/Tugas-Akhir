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
use App\Http\Controllers\Review\CategoryController;
use App\Http\Controllers\Review\IeeeController;
use App\Http\Controllers\Review\ScopusController;
use App\Http\Controllers\Review\ScrapingController;
use App\Exports\UsersExport;
use App\Http\Controllers\Review\AcmController;
use App\Http\Controllers\Review\CiteSeerxController;
use App\Http\Controllers\Review\ReviewMasterController;
use App\Http\Controllers\Review\ScienceDirectController;
use App\Http\Controllers\Review\SpringerController;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;


Route::middleware('auth')->group(function () {
    Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
    Route::middleware(['1', 'auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/search-route/{search}', function ($search) {
            // Mendapatkan semua rute yang terdaftar dalam aplikasi
            $routes = Route::getRoutes();

            // Array untuk menyimpan rute yang sesuai dengan kata kunci pencarian
            $filteredRoutes = [];

            foreach ($routes as $route) {
                // Pencarian pada URI rute
                if (strpos($route->uri(), $search) !== false) {
                    $filteredRoutes[] = $route;
                }

                // Pencarian pada nama rute
                if (strpos($route->getName(), $search) !== false) {
                    $filteredRoutes[] = $route;
                }
            }

            // Mengonversi array rute yang sesuai ke dalam format JSON dan mengirimkannya sebagai respons
            return response()->json($filteredRoutes);
        });



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

        Route::prefix("review")->group(function () {
            Route::controller(ReviewMasterController::class)->group(function () {
                Route::get('/master', 'index')->name('review.master.index');
                Route::post('/post-data', 'create')->name('review.master.create');
            });
            Route::controller(IeeeController::class)->group(function () {
                Route::get('/article-ieee', 'index')->name('review.ieee.index');
            });
            Route::controller(ScienceDirectController::class)->group(function () {
                Route::get('/sciencedirect', 'index')->name('review.sciencedirect.index');
            });
            Route::controller(SpringerController::class)->group(function () {
                Route::get('/springer', 'index')->name('review.springer.index');
            });
            Route::controller(AcmController::class)->group(function () {
                Route::get('/acm', 'index')->name('review.acm.index');
            });
            Route::controller(CiteSeerxController::class)->group(function () {
                Route::get('/citeseerx', 'index')->name('review.citeseerx.index');
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
