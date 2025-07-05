<?php

namespace App\Traits\Crud;

use Illuminate\Pagination\LengthAwarePaginator;

trait HandlesPaginate
{
    public function paginate($perPage): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }
}
