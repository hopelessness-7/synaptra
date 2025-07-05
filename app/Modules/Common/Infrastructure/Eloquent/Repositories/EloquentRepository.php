<?php

namespace App\Modules\Common\Infrastructure\Eloquent\Repositories;

use App\Modules\Common\Domain\Contracts\SearchRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EloquentRepository implements SearchRepositoryInterface
{
    public function search(Model $model, string $query, array $options = []): iterable
    {
        if (!array_key_exists('field', $options) || !empty($options['field'] !== '')) {
            return [];
        }

        return $model->newQuery()
            ->when($query, function (Builder $q) use ($query, $options) {
                if (!empty($options['exact'])) {
                    return $q->where($options['field'], $query);
                }

                return $q->where($options['field'], 'like', "%{$query}%");
            })->get();
    }
}
