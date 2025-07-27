<?php

namespace App\Modules\AccessControl\Application\UseCases\Permission;

use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\PermissionRepository;
use App\Traits\Crud\HandlesGet;

class Get
{
    use HandlesGet;

    public function __construct(
        private readonly PermissionRepository $repository
    ){}
}
