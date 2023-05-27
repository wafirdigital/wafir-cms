<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;

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
    Route::post('admin-login', [AdminAuthController::class, 'login']);
});

Route::group(['middleware' => 'auth:api','prefix' => 'v1'], function(){
    Route::resource('users',  UserController::class);
    Route::resource('roles',  RoleController::class);
    Route::resource('posts',  PostController::class);
    Route::resource('admins', AdminController::class);
});


