<?php

namespace App\Modules\Common\Domain\Traits;

use App\Modules\Common\Domain\Observers\ElasticsearchObserver;

trait Searchable
{
    public static function bootSearchable(): void
    {
        // Это облегчает переключение флага поиска.
        if (function_exists('config') && config('services.search.enabled', false)) {
            static::observe(ElasticsearchObserver::class);
        }
    }

    public function getSearchIndex(): string
    {
        return $this->getTable();
    }

    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }
        return $this->getTable();
    }

    public function toSearchArray(): array
    {
        return $this->toArray();
    }
}
