<?php

namespace App\Modules\Project\Application\UseCases\ProjectRole;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectRoleRepository;
use App\Traits\Crud\HandlesCreate;

class Create
{
    use HandlesCreate;

    public function __construct(
        private readonly ProjectRoleRepository $repository
    ){}
}
