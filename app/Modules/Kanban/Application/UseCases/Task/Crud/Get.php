<?php

namespace App\Modules\Kanban\Application\UseCases\Task\Crud;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskRepository;
use App\Traits\Crud\HandlesGet;

class Get
{
    use HandlesGet;

    public function __construct(
        private readonly TaskRepository $repository
    ){}
}
