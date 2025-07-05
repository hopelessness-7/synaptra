<?php

namespace Modules\Kanban\Infrastructure\Observers;

use Modules\Auth\Infrastructure\Events\BoardUpdatedEvent;
use Modules\Kanban\Infrastructure\Models\Board;

class BoardObserver
{
    public function created(Board $board): void
    {
        event(new BoardUpdatedEvent($board->id));
    }

    public function updated(Board $board): void
    {
        event(new BoardUpdatedEvent($board->id));
    }
}
