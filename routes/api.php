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
Route::post('films/{film}/image/upload', \App\Http\Controllers\FilmImageUploadController::class);

Route::apiResource('films', \App\Http\Controllers\FilmController::class);

Route::post('register',[\App\Http\Controllers\UserAuthController::class,'register']);
Route::post('login',[\App\Http\Controllers\UserAuthController::class,'login']);

Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [\App\Http\Controllers\UserAuthController::class, 'logout']);
    Route::post('/films/{film}/rate/', \App\Http\Controllers\RateFilmAuthUserController::class);
});
