<?php

namespace App\Traits\Crud;

use Illuminate\Database\Eloquent\Model;

trait HandlesRead
{
    public function show(int $id): ?Model
    {
        return $this->repository->find($id);
    }
}
