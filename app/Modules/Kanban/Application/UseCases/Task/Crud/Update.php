<?php

namespace App\Modules\Kanban\Application\UseCases\Task\Crud;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskRepository;
use App\Traits\Crud\HandlesUpdate;

class Update
{
    use HandlesUpdate;

    public function __construct(
        private readonly TaskRepository $repository
    ){}
}
