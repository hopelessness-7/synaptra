<?php

namespace App\Contracts;

use App\DTO\BaseDTO;
use Illuminate\Database\Eloquent\Model;

interface DTORepositoryInterface
{
    public function createFromDTO(BaseDTO $dto): Model;
    public function updateFromDTO(Model $model, BaseDTO $dto): Model;
}
