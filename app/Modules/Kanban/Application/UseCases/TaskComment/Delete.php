<?php

namespace App\Modules\Kanban\Application\UseCases\TaskComment;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskCommentRepository;
use App\Traits\Crud\HandlesDelete;

class Delete
{
    use HandlesDelete;

    public function __construct(
        private readonly TaskCommentRepository $repository
    ){}
}
