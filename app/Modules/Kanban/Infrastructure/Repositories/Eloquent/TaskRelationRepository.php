<?php

namespace App\Modules\Kanban\Infrastructure\Repositories\Eloquent;

use App\Modules\Kanban\Domain\Enums\RelationTypeEnum;
use Illuminate\Support\Facades\DB;

class TaskRelationRepository
{
    public function deleteRelationWithType(array $ids, RelationTypeEnum $relationType, int $taskId): void
    {
        DB::table('task_relations')
            ->where('task_id', $taskId)
            ->whereIn('related_task_id', $ids)
            ->where('relation_type', $relationType)
            ->delete();
    }
}
