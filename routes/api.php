<?php

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
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:api')->prefix('v1')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('/news', App\Http\Controllers\NewsController::class)->middleware('checkRole:admin')->except(['show']);
    Route::post('/news_list', [App\Http\Controllers\NewsController::class, 'news_list']);
    
    Route::apiResource('/comments', App\Http\Controllers\CommentController::class)->middleware('checkRole:non_admin');

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});
