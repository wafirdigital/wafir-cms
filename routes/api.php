<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ProductController;

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

Route::group(['prefix' => 'auth'], function(){
    Route::post('register',    [UserAuthController::class, 'register']);
    Route::post('login',       [UserAuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:api', 'prefix'=> 'v1'], function(){
    Route::resource('users',     UserController::class);
    Route::resource('bids',      BidController::class);
    Route::resource('products',  ProductController::class);
});


