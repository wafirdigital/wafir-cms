<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\MediaController;

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

Route::group(['prefix' => 'v1'], function(){

    Route::group(['prefix' => 'auth'], function(){
        Route::post('register',    [UserAuthController::class, 'register']);
        Route::post('login',       [UserAuthController::class, 'login']);
    });

    Route::group(['middleware' => 'auth:api'], function(){
        Route::resource('users',       UserController::class);
        Route::resource('topics',      TopicController::class);
        Route::resource('posts',       PostController::class);
        Route::resource('tags',        TagController::class);
        Route::resource('media',       MediaController::class);
    });

});






