<?php

namespace App\Modules\AccessControl\Application\UseCases\Permission;

use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\PermissionRepository;
use App\Traits\Crud\HandlesRead;

class Show
{
    use HandlesRead;

    public function __construct(
        private readonly PermissionRepository $repository
    ){}
}
