<?php

namespace Services\User\AuthService\Http;

use Illuminate\Support\Facades\Route;
use Services\AuthService\Http\Controllers\AuthController;

Route::prefix('auth')->middleware('auth:api')->controller(AuthController::class)->group(function(){
    Route::post('user', 'user')->name("user");
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::prefix('auth')->controller(AuthController::class)->group(function(){
    Route::post('login', 'login')->name("login");
    Route::post('register', 'register');
});
