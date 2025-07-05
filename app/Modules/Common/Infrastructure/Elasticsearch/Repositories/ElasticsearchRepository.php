<?php

namespace App\Modules\Common\Infrastructure\Elasticsearch\Repositories;

use App\Modules\Common\Domain\Contracts\SearchRepositoryInterface;
use Elastic\Elasticsearch\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ElasticsearchRepository implements SearchRepositoryInterface
{
    private $elasticsearch;

    public function search(Model $model, string $query, array $options = []): iterable
    {
        $this->elasticsearch = app(Client::class);
        $items = $this->handle($model, $query, $options);
        return $this->buildCollection($items, $model);
    }

    private function handle(Model $model, string $query, array $options = []): array
    {
        if (!empty($options['field'])) {
            return [];
        }

        $query = str_replace('@', '\@', $query);

        if (!empty($options['exact'])) {
            return $this->exact($model, $options['field'], $query);
        }

        return $this->fullText($model, $options['field'], $query);
    }

    private function exact(Model $model, $field, $query): array
    {

        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'match' => [
                                $field => $query
                            ]
                        ]
                    ],
                ],
            ],
        ]);

        return $items['hits']['hits'];
    }

    private function fullText(Model $model, $field, $query): array
    {
        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'query_string' => [
                                    'fields' => [$field],
                                    'query' => '*' . $query . '*',
                                ],
                            ]
                        ],
                    ],
                ],
            ],
        ]);

        return $items['hits']['hits'];
    }

    private function buildCollection(array $items, Model $modelEloquent): Collection
    {
        $ids = Arr::pluck($items, '_id');

        return $modelEloquent->newQuery()->whereIn('id', $ids)->get();

    }
}
