<?php

namespace App\Modules\Kanban\Application\UseCases\Task\Crud;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskRepository;
use App\Traits\Crud\HandlesDelete;

class Delete
{
    use HandlesDelete;

    public function __construct(
        private readonly TaskRepository $repository
    ){}
}
