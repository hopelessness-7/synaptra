<?php

namespace App\Modules\Kanban\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Kanban\Domain\Enums\PriorityEnum;
use App\Modules\Kanban\Domain\Enums\RelationTypeEnum;
use App\Modules\Kanban\Domain\Enums\StatusEnum;
use App\Modules\Kanban\Infrastructure\Traits\HasTaskLogging;
use App\Modules\Kanban\Infrastructure\Traits\ManagesBelongsToMany;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;
use Illuminate\Database\Eloquent\Collection;
use Modules\Kanban\Infrastructure\Models\Task;

class TaskRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO, ManagesBelongsToMany, HasTaskLogging;

    public function __construct(Task $task)
    {
        parent::__construct($task);
    }

    public function addWatchers(Task $task, int|array $watcherIds): Task
    {
        $this->attachRelation($task->watchers(), $watcherIds);
        $this->logRelation($task, 'watchers', 'add', $watcherIds);
        return $task;
    }

    public function removeWatchers(Task $task, int|array $watcherIds): Task
    {
        $this->detachRelation($task->watchers(), $watcherIds);
        $this->logRelation($task, 'watchers', 'remove', $watcherIds);
        return $task;
    }

    public function addCoAssignees(Task $task, int|array $coAssigneeIds): Task
    {
        $this->attachRelation($task->coAssignees(), $coAssigneeIds);
        $this->logRelation($task, 'coAssignees', 'add', $coAssigneeIds);
        return $task;
    }

    public function removeCoAssignees(Task $task, int|array $coAssigneeIds): Task
    {
        $this->detachRelation($task->coAssignees(), $coAssigneeIds);
        $this->logRelation($task, 'coAssignees', 'remove', $coAssigneeIds);
        return $task;
    }

    public function addRelated(Task $task, int|array $relatedTaskIds): Task
    {
        $this->attachRelationWithType($task->relatedTasks(), $relatedTaskIds,  RelationTypeEnum::Related);
        $this->logRelation($task, RelationTypeEnum::Related, 'add', $relatedTaskIds);
        return $task;
    }

    public function removeRelated(Task $task, int|array $relatedTaskIds): Task
    {
        $this->detachRelationWithType($relatedTaskIds, RelationTypeEnum::Related, $task->id);
        $this->logRelation($task, RelationTypeEnum::Related, 'remove', $relatedTaskIds);
        return $task;
    }

    public function addBlockedBy(Task $task, int|array $blockedTaskIds): Task
    {
        $this->attachRelationWithType($task->blockedBy(), $blockedTaskIds,  RelationTypeEnum::BlockedBy);
        $this->logRelation($task, RelationTypeEnum::BlockedBy, 'add', $blockedTaskIds);
        return $task;
    }

    public function removeBlockedBy(Task $task, int|array $blockedTaskIds): Task
    {
        $this->detachRelationWithType($blockedTaskIds, RelationTypeEnum::BlockedBy, $task->id);
        $this->logRelation($task, RelationTypeEnum::BlockedBy, 'remove', $blockedTaskIds);
        return $task;
    }

    public function addChildren(Task $task, int|array $childTaskIds): Task
    {
        $this->attachRelationWithType($task->children(), $childTaskIds,  RelationTypeEnum::Child);
        $this->logRelation($task, RelationTypeEnum::Child, 'add', $childTaskIds);
        return $task;
    }

    public function removeChildren(Task $task, int|array $childTaskIds): Task
    {
        $this->detachRelationWithType($childTaskIds, RelationTypeEnum::Child, $task->id);
        $this->logRelation($task, RelationTypeEnum::Child, 'remove', $childTaskIds);
        return $task;
    }

    public function addParents(Task $task, int|array $parentTaskIds): Task
    {
        $this->attachRelationWithType($task->parents(), $parentTaskIds,  RelationTypeEnum::Parent);
        $this->logRelation($task, RelationTypeEnum::Parent, 'add', $parentTaskIds);
        return $task;
    }

    public function removeParents(Task $task, int|array $parentTaskIds): Task
    {
        $this->detachRelationWithType($parentTaskIds, RelationTypeEnum::Parent, $task->id);
        $this->logRelation($task, RelationTypeEnum::Parent, 'remove', $parentTaskIds);
        return $task;
    }

    public function getUrgentTasks(int $userId, int $daysAhead = 2): Collection
    {
        $now = now();
        $limitDate = $now->copy()->addDays($daysAhead);

        return $this->model
            ->select('id', 'title', 'status', 'priority', 'finished_at')
            ->where('status', StatusEnum::Pending)
            ->whereIn('priority', [
                PriorityEnum::Medium,
                PriorityEnum::High,
                PriorityEnum::Urgent,
            ])
            ->where(function ($query) use ($userId) {
                $query->where('assignee_id', $userId)
                    ->orWhereHas('coAssignees', fn($q) => $q->where('user_id', $userId));
            })
            ->where(function ($query) use ($now, $limitDate) {
                $query->whereBetween('finished_at', [$now, $limitDate])
                    ->orWhereNull('finished_at');
            })
            ->orderByRaw("CASE WHEN finished_at IS NULL THEN 1 ELSE 0 END")
            ->orderBy('finished_at', 'asc')
            ->orderBy('priority', 'desc')
            ->limit(3)
            ->get();
    }

    public function getWeeklyTasks(int $userId): Collection
    {
        $now = now();
        $weekLater = $now->copy()->addDays(7);

        return $this->model
            ->select('id', 'title', 'status', 'priority', 'finished_at')
            ->where('status', StatusEnum::Pending)
            ->where(function ($query) use ($userId) {
                $query->where('assignee_id', $userId)
                    ->orWhereHas('coAssignees', fn($q) => $q->where('user_id', $userId));
            })
            ->whereNotNull('finished_at')
            ->whereBetween('finished_at', [$now, $weekLater])
            ->orderBy('finished_at', 'asc')
            ->limit(10)
            ->get();
    }

    public function countCompletedTasksForUser(int $userId): int
    {
        return $this->model->where(function ($query) use ($userId) {
            $query->where('assignee_id', $userId)
                ->orWhereHas('coAssignees', fn($q) => $q->where('user_id', $userId));
        })->where('status', StatusEnum::Completed)->count();
    }
}
