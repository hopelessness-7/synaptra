<?php

namespace Modules\Kanban\Infrastructure\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskComment extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'comment',
        'task_id',
        'user_id',
        'parent_comment_id'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parentComment(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_comment_id');
    }
}
