<?php

use App\Modules\Auth\Http\Middleware\AuthApiMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Modules\Auth\Http\Middleware\JwtTokenProtectionMiddleware;
use Modules\Auth\Http\Middleware\WebJwtAuthenticateMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.api' => AuthApiMiddleware::class,
            'jwt.protect' => JwtTokenProtectionMiddleware::class,
            'auth.web' => WebJwtAuthenticateMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
