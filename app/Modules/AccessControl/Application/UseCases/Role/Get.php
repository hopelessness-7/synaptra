<?php

namespace App\Modules\AccessControl\Application\UseCases\Role;

use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\RoleRepository;
use App\Traits\Crud\HandlesGet;

class Get
{
    use HandlesGet;

    public function __construct(
        private readonly RoleRepository $repository
    ){}
}
