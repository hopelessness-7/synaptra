<?php

namespace App\Modules\Kanban\Infrastructure\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TaskCoAssingnee extends Pivot
{
    protected $table = 'task_co_assignees';
    protected $fillable = ['task_id', 'user_id'];
}
