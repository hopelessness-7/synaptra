<?php

namespace Modules\Kanban\Infrastructure\Observers;

use Modules\Auth\Infrastructure\Events\BoardUpdatedEvent;
use Modules\Kanban\Infrastructure\Models\Column;

class ColumnObserver
{
    public function created(Column $column): void
    {
        event(new BoardUpdatedEvent($column->board_id));
    }

    public function updated(Column $column): void
    {
        event(new BoardUpdatedEvent($column->board_id));
    }
}
