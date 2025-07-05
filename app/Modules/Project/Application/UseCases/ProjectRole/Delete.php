<?php

namespace App\Modules\Project\Application\UseCases\ProjectRole;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectRoleRepository;
use App\Traits\Crud\HandlesDelete;

class Delete
{
    use HandlesDelete;

    public function __construct(
        private readonly ProjectRoleRepository $repository
    ){}
}
