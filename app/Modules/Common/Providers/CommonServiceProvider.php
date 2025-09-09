<?php

namespace Modules\Common\Providers;

use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
    }
}
