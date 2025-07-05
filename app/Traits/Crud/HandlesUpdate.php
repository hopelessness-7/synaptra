<?php

namespace App\Traits\Crud;

use App\DTO\BaseDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait HandlesUpdate
{
    public function update(BaseDTO $dto): Model
    {
        $model = $this->repository->find($dto->id);

        if (!$model) {
            throw new ModelNotFoundException();
        }

        return $this->repository->updateFromDTO($model, $dto);
    }
}
