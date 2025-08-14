<?php

namespace App\Modules\AccessControl\Application\UseCases\Role;

use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\RoleRepository;
use App\Traits\Crud\HandlesRead;

class Show
{
    use HandlesRead;

    public function __construct(
        private readonly RoleRepository $repository
    ){}
}
