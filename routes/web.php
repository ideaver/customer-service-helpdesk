<?php

use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::any('/', [AdminController::class, "login"]);
Route::post('signin', [AdminController::class, "actionSignin"])->name('signin');

Route::group(['middleware' => ['my.auth']], function () {
    Route::get('signout', [AdminController::class, "actionSignout"])->name('signout');

    Route::any('/chat', [ChatController::class, "chat"]);

    Route::any('/dashboard', [DashboardController::class, "dashboard"]);
    Route::any('/dashboard/{slug}', [DashboardController::class, "view"]);

    Route::get('/admin', [AdminController::class, "admin"]);
    Route::post('/admin-dt', [AdminController::class, "getDatatablesAdmin"]);

    Route::get('/admin/create', [AdminController::class, "create"]);
    Route::post('/admin/create', [AdminController::class, "actionCreate"])->name('post.admin.create');
    Route::get('/admin/{uuid}', [AdminController::class, "update"]);
    Route::post('/admin/update', [AdminController::class, "actionUpdate"])->name('post.admin.update');

    Route::any('/admin/password', [AdminController::class, "password"]);
    Route::any('/user/{slug}', [UserController::class, "view"]);
});
