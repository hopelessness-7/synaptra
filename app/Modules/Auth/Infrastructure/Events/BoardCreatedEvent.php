<?php

namespace Modules\Auth\Infrastructure\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Modules\Kanban\Infrastructure\Models\Board;

class BoardCreatedEvent
{
    public function __construct(
        public int $boardId,
    ){}
}
