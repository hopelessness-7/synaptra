<?php

namespace App\Providers;

use App\Contracts\CacheRepositoryInterface;
use App\Modules\Auth\Providers\AuthServiceProvider;
use App\Modules\Auth\Providers\ExceptionServiceProvider;
use App\Modules\Common\Providers\SearchServiceProvider;
use App\Repositories\Cache\CacheRepository;
use Illuminate\Support\ServiceProvider;
use Modules\AccessControl\Providers\AccessControlServiceProvider;
use Modules\Common\Providers\CommonServiceProvider;
use Modules\Kanban\Providers\KanbanServiceProvider;
use Modules\Project\Providers\ProjectServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(ModuleCommandServiceProvider::class);
        $this->app->bind(CacheRepositoryInterface::class, CacheRepository::class);

        // Модуль Common - общий
        $this->app->register(SearchServiceProvider::class);
        $this->app->register(CommonServiceProvider::class);

        // Модуль AUTH
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(ExceptionServiceProvider::class);
        // Модуль PROJECT
        $this->app->register(ProjectServiceProvider::class);

        $this->app->register(KanbanServiceProvider::class);

        $this->app->register(AccessControlServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
