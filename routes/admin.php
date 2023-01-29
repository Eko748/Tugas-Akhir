<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Management\EmployeeController;
use App\Http\Controllers\Admin\Management\ProductController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::middleware('auth')->group(function () {
    Route::post('/gettimelogin', [AdminController::class, 'getTimeLogging']);
    Route::middleware(['1'])->group(function () {
        // Dashboard
        Route::get('/dashboard-admin', [DashboardController::class, 'index'])->name('dashboard.admin.index');

        // Management | Employee
        Route::prefix("management")->group(function() {
            Route::controller(EmployeeController::class)->group(function() {
                Route::get('/employee', 'index')->name('management.employee.index');
                Route::get('/employee-data', 'getTable')->name('management.employee.table');
                Route::get('/employee-data-user', 'getUser')->name('management.employee.getUsers');
                Route::post('/employee-create', 'create')->name('management.employee.create');
                Route::get('/employee-edit', 'edit')->name('management.employee.edit');
                Route::put('/employee-update', 'update')->name('management.employee.update');
                Route::post('/employee-delete/{id}', 'delete')->name('management.employee.delete');
                Route::post('/store-toko', 'storeToko')->name('management.toko.create');   
            });

            Route::controller(ProductController::class)->group(function() {
                Route::get('/product', 'index')->name('management.product.index');
                Route::get('/product/fetch-data', 'getMoreUsers')->name('management.product.fetch');
                Route::get('/product/user-data', 'selectSearch')->name('management.product.selectSearch');
                Route::get('/product/search-data', 'search')->name('management.product.search');
            });
        });

        // Route::get('/management/employee-create', [RegisteredUserController::class, 'create'])->name('management.employee.create');
        // Management | Employee
        Route::get('/finance/coa', [EmployeeController::class, 'index'])->name('finance.coa.index');
        Route::get('/finance/coa-data', [EmployeeController::class, 'getTable'])->name('finance.coa.table');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
