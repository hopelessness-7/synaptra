<?php

use App\Modules\Common\Http\Controllers\Web\DashboardController;
use Illuminate\Support\Facades\Route;
use Modules\Common\Http\Controllers\Web\FinishOnboardingController;
use Modules\Common\Http\Controllers\Web\OnboardingController;
use Modules\Common\Http\Controllers\Web\OnboardingNextStepController;

Route::middleware(['web', 'auth.web'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('onboarding')->group(function () {
        Route::get('/{step}', OnboardingController::class)->name('onboarding.step');
        Route::post('/{step}/next', [OnboardingNextStepController::class, 'handle'])->name('onboarding.step.next');
        Route::post('/finish', FinishOnboardingController::class)->name('onboarding.finish');
    });
});
