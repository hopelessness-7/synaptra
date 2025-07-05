<?php

namespace App\Modules\Kanban\Application\UseCases\Board;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\BoardRepository;
use App\Traits\Crud\HandlesDelete;

class Delete
{
    use HandlesDelete;

    public function __construct(
        private readonly BoardRepository $repository
    ){}
}
