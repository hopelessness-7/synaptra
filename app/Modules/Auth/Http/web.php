<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Web\LoginController;
use Modules\Auth\Http\Controllers\Web\LogoutController;
use Modules\Auth\Http\Controllers\Web\RegisterController;

Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.view');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::get('/register', [RegisterController::class, 'index'])->name('register.view');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    Route::middleware(['auth.web'])->group(function () {
        Route::post('/logout', LogoutController::class)->name('logout');
    });
});
