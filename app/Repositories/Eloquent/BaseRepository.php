<?php

namespace App\Repositories\Eloquent;

use App\Contracts\EloquentBaseInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BaseRepository implements EloquentBaseInterface
{
    protected Model $model;
    protected Builder $query;

    protected function modelException ($model): Model
    {
        if (!$model) {
            throw new \Exception('item not found', 404);
        }

        return $model;
    }

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->query = $model->newQuery();
    }

    public function paginate(int $paginate): LengthAwarePaginator
    {
        return $this->model->paginate($paginate);
    }

    public function find(int $id): ?Model
    {
        $model = $this->model->find($id);
        return $this->modelException($model);
    }

    public function findMany(array $ids): Collection
    {
        return $this->model->findMany($ids);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): Model
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }

    /**
     * Apply a basic where clause.
     */
    public function where(string|array $field, mixed $operatorOrValue = null, mixed $value = null): static
    {
        if (is_array($field)) {
            // Если $field — массив, передаем его в базовый метод Eloquent
            $this->query->where($field);
            return $this; // Сразу выходим, дальнейшая логика не нужна
        }

        // Если $value не задано, подразумевается использование '='
        if (is_null($value)) {
            $this->query->where($field, '=', $operatorOrValue);
        } else {
            // Передан оператор и значение
            $this->query->where($field, $operatorOrValue, $value);
        }

        return $this;
    }

    /**
     * Apply a whereIn clause.
     */
    public function whereIn(string $field, array $values): static
    {
        $this->query->whereIn($field, $values);
        return $this;
    }

    /**
     * Execute the query and return a collection.
     */
    public function get(): Collection
    {
        return $this->query->get();
    }

    public function queryPaginate(int $paginate): LengthAwarePaginator
    {
        return $this->query->paginate($paginate);
    }

    public function queryFind($id): ?Model
    {
        return $this->query->find($id);
    }

    public function queryFirst(): ?Model
    {
        return $this->query->first();
    }

    public function queryUpdate($array): int
    {
        return $this->query->update($array);
    }

    /**
     * Apply a select clause.
     */
    public function select(array $columns): static
    {
        $this->query->select($columns);
        return $this;
    }

    /**
     * Reset query for a new request (optional utility method).
     */
    public function queryReset(): static
    {
        $this->query = $this->model->newQuery();
        return $this;
    }

    public function queryExists(): bool
    {
        $this->query->exists();
    }
}
