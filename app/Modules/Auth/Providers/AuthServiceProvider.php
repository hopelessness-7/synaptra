<?php

namespace App\Modules\Auth\Providers;

use App\Modules\Auth\Application\Commands\CleanBlacklist;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Providers\AuthEventServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Infrastructure/Database/Migrations');

        $this->commands([
            CleanBlacklist::class
        ]);

        $this->app->register(AuthEventServiceProvider::class);
    }
}
