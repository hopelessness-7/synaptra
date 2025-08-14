<?php

namespace App\Modules\AccessControl\Application\UseCases\Role;

use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\RoleRepository;
use App\Traits\Crud\HandlesUpdate;

class Update
{
    use HandlesUpdate;

    public function __construct(
        private readonly RoleRepository $repository
    ){}
}
