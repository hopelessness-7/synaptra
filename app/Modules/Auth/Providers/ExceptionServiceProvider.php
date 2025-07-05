<?php

namespace App\Modules\Auth\Providers;

use App\Modules\Auth\Infrastructure\Exceptions\RenderExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider;

class ExceptionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ExceptionHandler::class, RenderExceptionHandler::class);
    }
}
