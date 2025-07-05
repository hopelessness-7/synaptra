<?php

namespace Modules\Kanban\Infrastructure\Observers;

use App\Modules\Kanban\Infrastructure\Services\TaskLogService;
use Modules\Auth\Infrastructure\Events\BoardUpdatedEvent;
use Modules\Kanban\Infrastructure\Models\Task;

class TaskObserver
{
    public function __construct(
        private readonly TaskLogService $logService
    ) {}

    public function created(Task $task): void
    {
        $this->logService->logCreated($task);
        event(new BoardUpdatedEvent($task->column->board_id));
    }

    public function updated(Task $task): void
    {
        $this->logService->logUpdated($task);

        $watchedFields = ['title', 'position', 'column_id', 'assignee_id'];

        if ($task->wasChanged($watchedFields)) {
            event(new BoardUpdatedEvent($task->column->board_id));
        }
    }
}
