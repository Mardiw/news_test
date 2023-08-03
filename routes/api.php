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
    Route::apiResource('/news', App\Http\Controllers\NewsController::class);
});

// Route::middleware('auth:api')->group(function () {
//     Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
//     Route::apiResource('/employee', App\Http\Controllers\EmployeeController::class);
//     Route::apiResource('/supplier', App\Http\Controllers\SupplierController::class);
//     Route::apiResource('/category', App\Http\Controllers\CategoryController::class);
//     Route::apiResource('/product', App\Http\Controllers\ProductController::class);
//     Route::apiResource('/expense', App\Http\Controllers\ExpenseController::class);
// });
