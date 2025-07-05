<?php

namespace App\Modules\Kanban\Application\UseCases\Column;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\ColumnRepository;
use App\Traits\Crud\HandlesGet;

class Get
{
    use HandlesGet;

    public function __construct(
        private readonly ColumnRepository $repository
    ){}
}
