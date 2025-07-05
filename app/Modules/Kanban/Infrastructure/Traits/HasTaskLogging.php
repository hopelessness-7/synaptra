<?php

namespace App\Modules\Kanban\Infrastructure\Traits;

use BackedEnum;
use Modules\Kanban\Infrastructure\Models\Task;

trait HasTaskLogging
{
    protected function logRelation(Task $task, string|BackedEnum $relation, string $action, int|array $relatedIds): void
    {
        if (isset($this->taskLogService)) {
            $this->taskLogService->logRelationChange($task, $relation, $action, $relatedIds);
        }
    }
}
