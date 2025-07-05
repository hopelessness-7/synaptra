<?php

namespace App\Modules\Common\Providers;

use App\Modules\Common\Application\Commands\ElasticSearch\DeleteCommand;
use App\Modules\Common\Application\Commands\ElasticSearch\ReindexCommand;
use App\Modules\Common\Domain\Contracts\SearchRepositoryInterface;
use App\Modules\Common\Infrastructure\Elasticsearch\Repositories\ElasticsearchRepository;
use App\Modules\Common\Infrastructure\Eloquent\Repositories\EloquentRepository;
use App\Modules\Common\Infrastructure\Repositories\SwitchableSearchRepository;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts([config('services.search.host')])
                ->build();
        });

        $this->app->singleton(SearchRepositoryInterface::class, function ($app) {
            $elasticRepo = $app->make(ElasticsearchRepository::class);
            $fallbackRepo = $app->make(EloquentRepository::class);

            return new SwitchableSearchRepository($elasticRepo, $fallbackRepo);
        });

        $this->app->singleton(ElasticsearchRepository::class, function ($app) {
            return new ElasticsearchRepository();
        });

        $this->app->singleton(EloquentRepository::class, function ($app) {
            return new EloquentRepository();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->commands([
            ReindexCommand::class,
            DeleteCommand::class,
        ]);
    }
}
