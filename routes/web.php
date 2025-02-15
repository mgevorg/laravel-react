<?php

use Illuminate\Support\Facades\Route;
use Services\AuthService\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', [AuthController::class, 'user']);