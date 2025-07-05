<?php

namespace Modules\Kanban\Infrastructure\Models;

use App\Models\User;
use App\Modules\Kanban\Domain\Enums\PriorityEnum;
use App\Modules\Kanban\Domain\Enums\StatusEnum;
use App\Traits\HasModuleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    use HasModuleFactory {
        HasModuleFactory::newFactory insteadof HasFactory;
    }

    protected $fillable = [
        'title',
        'description',
        'position',
        'status',
        'priority',
        'due_date',
        'started_at',
        'finished_at',
        'estimated_time',
        'spent_time',
        'column_id',
        'assignee_id',
        'creator_id',
    ];

    protected $casts = [
        'due_date' => 'date',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'priority' => PriorityEnum::class,
        'status' =>  StatusEnum::class,
    ];

    public function column(): BelongsTo
    {
        return $this->belongsTo(Column::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function watchers(): BelongsToMany
    {
        return  $this->belongsToMany(User::class, 'task_watchers', 'task_id', 'user_id');
    }

    public function coAssignees(): BelongsToMany
    {
        return  $this->belongsToMany(User::class, 'task_co_assignees', 'task_id', 'user_id');
    }

    public function relatedTasks(): BelongsToMany
    {
        return  $this->belongsToMany(__CLASS__, 'task_relations', 'task_id', 'related_task_id')
            ->wherePivot('relation_type', 'related')
            ->withTimestamps()
            ->withPivot('relation_type');
    }

    public function blockedBy(): BelongsToMany
    {
        return  $this->belongsToMany(__CLASS__, 'task_relations', 'task_id', 'related_task_id')
            ->wherePivot('relation_type', 'blocked_by')
            ->withTimestamps()
            ->withPivot('relation_type');
    }

    public function children():  BelongsToMany
    {
        return  $this->belongsToMany(__CLASS__, 'task_relations', 'task_id', 'related_task_id')
            ->withPivot('relation_type', 'child')
            ->withTimestamps()
            ->withPivot('relation_type');
    }

    public function parents():  BelongsToMany
    {
        return  $this->belongsToMany(__CLASS__, 'task_relations', 'task_id', 'related_task_id')
            ->withPivot('relation_type', 'parent')
            ->withTimestamps()
            ->withPivot('relation_type');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TaskComment::class, 'task_id');
    }

    public function logs(): HasMany
    {
        return $this->hasMany(TaskLog::class, 'task_id');
    }
}
