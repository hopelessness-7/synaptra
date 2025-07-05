<?php

namespace App\Providers;

use App\Console\Commands\ModuleMakeController;
use App\Console\Commands\ModuleMakeMigration;
use App\Console\Commands\ModuleMakeRequest;
use App\Console\Commands\ModuleMakeResource;
use Illuminate\Support\ServiceProvider;
use App\Console\Commands\ModuleMakeModel;

class ModuleCommandServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->commands([
            ModuleMakeModel::class,
            ModuleMakeMigration::class,
            ModuleMakeController::class,
            ModuleMakeRequest::class,
            ModuleMakeResource::class,
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
