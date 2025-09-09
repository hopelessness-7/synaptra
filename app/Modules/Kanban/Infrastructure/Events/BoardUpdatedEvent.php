<?php

namespace App\Modules\Kanban\Infrastructure\Events;


class BoardUpdatedEvent
{
    public function __construct(public int $boardId){}
}
