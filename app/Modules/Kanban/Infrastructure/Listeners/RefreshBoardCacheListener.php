<?php

namespace App\Modules\Kanban\Infrastructure\Listeners;

use App\Modules\Kanban\Infrastructure\Events\BoardUpdatedEvent;
use Modules\Kanban\Infrastructure\Jobs\RefreshBoardCacheJob;

class RefreshBoardCacheListener
{
    public function __construct(){}

    public function handle(BoardUpdatedEvent $event): void
    {
        RefreshBoardCacheJob::dispatch($event->boardId)
            ->onQueue('board-cache');
    }
}
