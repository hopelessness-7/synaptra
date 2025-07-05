<?php

namespace App\Modules\Project\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberMetric extends Model
{
    protected $fillable = [
        'member_id',
        'tasks_completed',
        'avg_task_time',
        'total_work_time',
        'quality_score',
        'activity_score'
    ];

    public $timestamps = false;

    public function member(): BelongsTo
    {
        return $this->belongsTo(ProjectMember::class);
    }
}
