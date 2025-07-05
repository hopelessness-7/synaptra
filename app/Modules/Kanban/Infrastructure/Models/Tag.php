<?php

namespace Modules\Kanban\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tag extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'color',
        'task_id',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
