<?php

namespace App\Modules\Project\Application\UseCases\Project;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectRepository;
use App\Traits\Crud\HandlesUpdate;

class Update
{
    use HandlesUpdate;

    public function __construct(
        private readonly ProjectRepository $repository
    ){}
}
