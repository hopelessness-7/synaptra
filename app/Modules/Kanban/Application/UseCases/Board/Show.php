<?php

namespace App\Modules\Kanban\Application\UseCases\Board;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\BoardRepository;
use App\Traits\Crud\HandlesRead;

class Show
{
    use HandlesRead;

    public function __construct(
        private readonly BoardRepository $repository
    ){}
}
