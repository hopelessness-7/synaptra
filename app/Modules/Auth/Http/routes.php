<?php

use App\Modules\Auth\Http\Controllers\Api\V1\LoginController;
use App\Modules\Auth\Http\Controllers\Api\V1\LogoutController;
use App\Modules\Auth\Http\Controllers\Api\V1\RegisterController;
use App\Modules\Auth\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->group(function () {
    Route::middleware('auth.api')->group(function () {
        Route::get('/profile', [UserController::class, 'show']);
        Route::get('/user/{id:int}', [UserController::class, 'show']);
        Route::post('/logout', LogoutController::class);
    });

    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);
});




