<?php

namespace App\Modules\AccessControl\Application\UseCases\Role;

use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\RoleRepository;
use App\Traits\Crud\HandlesDelete;

class Delete
{
    use HandlesDelete;

    public function __construct(
        private readonly RoleRepository $repository
    ){}
}
