<?php

namespace App\Modules\Common\Domain\Contracts;

use Illuminate\Database\Eloquent\Model;

interface SearchRepositoryInterface
{
    public function search(Model $model, string $query, array $options = []): iterable;
}
