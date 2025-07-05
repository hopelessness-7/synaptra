<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface EloquentBaseInterface
{
    public function find(int $id): ?Model;

    public function create(array $data): Model;

    public function update($id, array $data): Model;

    public function all(): Collection;

    public function delete(int $id): void;

    public  function paginate(int $paginate): LengthAwarePaginator;

    public function findMany(array $ids): Collection;

    public function where(string|array $field, mixed $operatorOrValue = null, mixed $value = null): static;

    public function whereIn(string $field, array $values): static;

    public function get(): Collection;

    public function select(array $columns): static;
}
