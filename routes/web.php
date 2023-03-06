<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TemplateChatController;
use App\Http\Controllers\TopicChatController;
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

Route::get('/', [AdminController::class, "login"]);
Route::post('signin', [AdminController::class, "actionSignin"])->name('signin');

Route::group(['middleware' => ['my.auth']], function () {
    Route::post('user/save-token', [AdminController::class, "actionSaveToken"]);
    Route::get('signout', [AdminController::class, "actionSignout"])->name('signout');

    Route::get('/chat', [ChatController::class, "chat"]);
    Route::get('/chat/{id}', [ChatController::class, "chat"]);
    Route::post('/chat/upload/{id}', [ChatController::class, "actionUploadChat"]);

    Route::any('/dashboard', [DashboardController::class, "dashboard"]);
    Route::any('/dashboard/{slug}', [DashboardController::class, "view"]);

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [AdminController::class, "admin"]);
        Route::post('/dt', [AdminController::class, "getDatatablesAdmin"]);

        Route::get('/create', [AdminController::class, "create"]);
        Route::post('/create', [AdminController::class, "actionCreate"])->name('post.admin.create');
        Route::get('/{uuid}', [AdminController::class, "update"]);
        Route::post('/update', [AdminController::class, "actionUpdate"])->name('post.admin.update');
    });

    Route::group(['prefix' => 'topic-chat'], function () {
        Route::get('/', [TopicChatController::class, "list"]);
        Route::post('/dt', [TopicChatController::class, "getDatatables"]);
        Route::get('/create', [TopicChatController::class, "create"]);
        Route::post('/create', [TopicChatController::class, "actionCreate"])->name('post.topic-chat.create');
        Route::get('/{uuid}', [TopicChatController::class, "update"]);
        Route::post('/update', [TopicChatController::class, "actionUpdate"])->name('post.topic-chat.update');
    });

    Route::group(['prefix' => 'template-chat'], function () {
        Route::get('/', [TemplateChatController::class, "list"]);
        Route::post('/dt', [TemplateChatController::class, "getDatatables"]);
        Route::get('/create', [TemplateChatController::class, "create"]);
        Route::post('/create', [TemplateChatController::class, "actionCreate"])->name('post.template-chat.create');
        Route::get('/{uuid}', [TemplateChatController::class, "update"]);
        Route::post('/update', [TemplateChatController::class, "actionUpdate"])->name('post.template-chat.update');
    });

    Route::any('/admin/password', [AdminController::class, "password"]);
    Route::any('/user/{slug}', [UserController::class, "view"]);
});
