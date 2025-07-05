<?php

namespace App\Modules\Common\Infrastructure\Repositories;

use App\Modules\Common\Domain\Contracts\SearchRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SwitchableSearchRepository implements SearchRepositoryInterface
{
    protected SearchRepositoryInterface $elastic;
    protected SearchRepositoryInterface $fallback;

    public function __construct(SearchRepositoryInterface $elastic, SearchRepositoryInterface $fallback)
    {
        $this->elastic = $elastic;
        $this->fallback = $fallback;
    }

    public function search(Model $model, string $query, array $options = []): iterable
    {
        try {
            return $this->elastic->search($model, $query, $options);
        } catch (\Throwable $e) {
            \Log::warning("Elasticsearch fallback: {$e->getMessage()}");
            return $this->fallback->search($model, $query, $options);
        }
    }
}
