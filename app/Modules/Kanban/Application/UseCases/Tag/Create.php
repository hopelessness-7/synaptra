<?php

namespace App\Modules\Kanban\Application\UseCases\Tag;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TagRepository;
use App\Traits\Crud\HandlesCreate;

class Create
{
    use HandlesCreate;

    public function __construct(
        private readonly TagRepository $repository
    ){}
}
