<?php

namespace Modules\Auth\Infrastructure\Events;


class BoardUpdatedEvent
{
    public function __construct(public int $boardId){}
}
