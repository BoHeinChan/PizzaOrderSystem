<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
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
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ApiController::class)->group(function () {
        Route::get('category_list', 'category_list');
        Route::get('pizza_list', 'pizza_list');
        Route::get('user_list', 'user_list');
    });

    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout');
    });
});
