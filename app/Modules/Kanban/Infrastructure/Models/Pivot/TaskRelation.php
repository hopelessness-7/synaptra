<?php

namespace App\Modules\Kanban\Infrastructure\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskRelation extends Pivot
{
    protected $table = 'task_relations';
    protected $fillable = ['task_id', 'related_task_id', 'relation_type'];
}
