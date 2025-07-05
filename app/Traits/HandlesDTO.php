<?php

namespace App\Traits;

use App\DTO\BaseDTO;
use Illuminate\Database\Eloquent\Model;

trait HandlesDTO
{
    public function createFromDTO(BaseDTO $dto): Model
    {
        return $this->model->create($dto->toArray());
    }

    public function updateFromDTO(Model $model, BaseDTO $dto): Model
    {
        $model->update($dto->toArray());
        return $model;
    }
}
