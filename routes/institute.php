<?php

// use App\Http\Controllers\Auth\AuthController;
// use App\Http\Controllers\Dashboard\DashboardController;
// use App\Http\Controllers\Management\ProductController;
// use App\Http\Controllers\Management\ProjectController;
// use Illuminate\Support\Facades\Route;

// Route::middleware('auth')->group(function () {
//     Route::post('/gettimelogin', [AuthController::class, 'getTimeLogging']);
//     Route::middleware(['1'])->group(function () {
//         Route::prefix("project")->group(function () {
//             Route::controller(ProjectController::class)->group(function () {
//                 Route::get('/master', 'index')->name('management.project.index');
//                 Route::get('/{uuid_project}', 'detail')->name('management.project.detail');
//                 Route::get('/fetch-data/{uuid_project}', 'getTable')->name('management.project.getTable');
//                 Route::get('/export-{uuid_project}', 'export')->name('management.project.export');
//                 Route::get('/project-list-data', 'getProject')->name('management.project.getProject');
//                 Route::post('/project-create', 'create')->name('management.project.create');
//             });
//         });
//     });
// });