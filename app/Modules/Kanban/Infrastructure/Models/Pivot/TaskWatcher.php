<?php

namespace App\Modules\Kanban\Infrastructure\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskWatcher extends Pivot
{
    protected $table = 'task_watchers';
    protected $fillable = ['task_id', 'user_id'];
}
