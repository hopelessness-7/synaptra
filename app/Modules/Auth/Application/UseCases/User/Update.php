<?php

namespace App\Modules\Auth\Application\UseCases\User;

use App\Repositories\Eloquent\UserRepository;
use App\Traits\Crud\HandlesUpdate;

class Update
{
    use HandlesUpdate;

    public function __construct(
        private readonly UserRepository $repository
    ){}
}
