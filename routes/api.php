<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(\App\Http\Controllers\Api\NewsController::class)->group(function () {
    Route::get('/news/{news}', 'show');
});

Route::controller(\App\Http\Controllers\Api\AuthorNewsController::class)->group(function () {
    Route::get('/author/{author}/news', 'show');
});

Route::controller(\App\Http\Controllers\Api\AuthorController::class)->group(function () {
    Route::get('/author/top', 'top');
});
