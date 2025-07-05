<?php

namespace App\Modules\Common\Domain\Observers;

use Elastic\Elasticsearch\Client;

class ElasticsearchObserver
{
    private Client $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function saved($model): void
    {
        try {

            $indexName = $model->getSearchIndex();

            if (!$this->elasticsearch->indices()->exists(['index' => $indexName])) {
                $this->elasticsearch->indices()->create([
                    'index' => $indexName,
                    'body' => [
                        'settings' => [
                            'analysis' => [
                                'analyzer' => [
                                    'prefix_analyzer' => [
                                        'type' => 'custom',
                                        'tokenizer' => 'keyword',
                                        'filter' => ['lowercase']
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]);

                $mappingProperties = [];

                foreach ($model->getAttributes() as $attribute => $value) {
                    if (is_bool($value)) {
                        $mappingProperties[$attribute] = [
                            'type' => 'boolean',
                        ];
                    }
                }

                $this->elasticsearch->indices()->putMapping([
                    'index' => $indexName,
                    'type' => $model->getSearchType(),
                    'body' => [
                        'properties' => $mappingProperties,
                    ],
                ]);
            }

            $this->elasticsearch->index([
                'index' => $indexName,
                'type' => $model->getSearchType(),
                'id' => $model->getKey(),
                'body' => $model->toSearchArray(),
            ]);

        } catch (\Elastic\Transport\Exception\NoNodeAvailableException $e) {
            $model->save();
        }
    }

    public function deleted($model): void
    {
        try {
            $this->elasticsearch->delete([
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
                'id' => $model->getKey(),
            ]);
        } catch (\Elastic\Transport\Exception\NoNodeAvailableException $e) {
            $model->delete();
        }
    }
}

