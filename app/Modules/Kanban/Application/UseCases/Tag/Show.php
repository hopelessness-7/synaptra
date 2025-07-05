<?php

namespace App\Modules\Kanban\Application\UseCases\Tag;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TagRepository;
use App\Traits\Crud\HandlesRead;

class Show
{
    use HandlesRead;

    public function __construct(
        private readonly TagRepository $repository
    ){}
}
