<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
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
Route::middleware('api')->group(function () {
    Route::apiResource('post', PostController::class);
    Route::resource('post', PostController::class);
    Route::resource('tag',TagController::class);
    Route::post('/post/{post}/tag/bulk',[PostController::class,'bulk']);
});






