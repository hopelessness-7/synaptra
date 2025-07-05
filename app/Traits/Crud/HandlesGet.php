<?php

namespace App\Traits\Crud;

use Illuminate\Database\Eloquent\Collection;

trait HandlesGet
{
    public function get(): Collection
    {
        return $this->repository->all();
    }
}
