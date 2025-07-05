<?php

namespace App\Traits\Crud;

use App\DTO\BaseDTO;
use Illuminate\Database\Eloquent\Model;

trait HandlesCreate
{
    public function create(BaseDTO $dto): Model
    {
        return $this->repository->createFromDTO($dto);
    }
}
