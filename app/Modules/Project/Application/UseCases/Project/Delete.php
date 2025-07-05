<?php

namespace App\Modules\Project\Application\UseCases\Project;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectRepository;
use App\Traits\Crud\HandlesDelete;

class Delete
{
    use HandlesDelete;

    public function __construct(
        private readonly ProjectRepository $repository
    ){}
}
