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


Route::resource('tasks', \App\Http\Controllers\TaskController::class);

Route::post('login',[\App\Http\Controllers\User\UserAuthController::class,'login']);

Route::get('goods',\App\Http\Controllers\Good\GoodController::class);

Route::middleware('auth:sanctum')->group( function () {
    Route::post('balance/add',[\App\Http\Controllers\Balance\BalanceController::class,'add']);
    Route::post('basket/add',[\App\Http\Controllers\Basket\BasketController::class,'add']);
    Route::delete('basket/delete/{good}',[\App\Http\Controllers\Basket\BasketController::class,'delete']);
    Route::post('order/create',[\App\Http\Controllers\Order\OrderController::class,'create']);
    Route::delete('order/delete/{order}',[\App\Http\Controllers\Order\OrderController::class,'delete']);
});
