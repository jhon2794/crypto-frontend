<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CryptoPriceController;
use App\Http\Controllers\CryptoPriceHistoryController;

Route::apiResource('users', UserController::class);
Route::apiResource('prices', CryptoPriceController::class);
Route::apiResource('histories', CryptoPriceHistoryController::class);
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
