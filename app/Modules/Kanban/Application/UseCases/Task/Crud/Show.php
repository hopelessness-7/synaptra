<?php

namespace App\Modules\Kanban\Application\UseCases\Task\Crud;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskRepository;
use App\Traits\Crud\HandlesRead;

class Show
{
    use HandlesRead;

    public function __construct(
        private readonly TaskRepository $repository
    ){}
}
