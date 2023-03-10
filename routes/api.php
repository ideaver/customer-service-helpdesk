<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('chat/get-thread', [ChatController::class, "actionGetThread"]);
Route::get('chat/get-chat', [ChatController::class, "actionGetChat"]);
Route::get('chat/get-topic', [ChatController::class, "actionGetTopic"]);

Route::post('chat/submit', [ChatController::class, "actionSubmit"]);
Route::post('chat/read', [ChatController::class, "actionRead"]);
Route::post('chat/done', [ChatController::class, "actionDone"]);
Route::post('chat/rating', [ChatController::class, "actionRating"]);

Route::post('user/submit', [UserController::class, "actionSubmit"]);
Route::post('user/save-one-signal-id', [UserController::class, "actionSaveToken"]);
