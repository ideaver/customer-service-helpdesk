<?php

use App\Http\Controllers\ChatController;
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

Route::get('chat/get-category', [ChatController::class, "actionGetCategory"]);
Route::post('chat/submit', [ChatController::class, "actionSubmit"]);
Route::post('chat/read', [ChatController::class, "actionRead"]);
Route::post('chat/done', [ChatController::class, "actionDone"]);
