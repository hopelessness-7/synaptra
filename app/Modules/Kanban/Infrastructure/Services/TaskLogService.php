<?php

namespace App\Modules\Kanban\Infrastructure\Services;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskLogRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;
use Modules\Kanban\Infrastructure\Models\Task;

class TaskLogService
{
    public function __construct(
        private readonly TaskLogRepository $logRepository,
        private readonly UserRepository $userRepository,
    ) {}

    public function logCreated(Task $task): void
    {
        $this->logRepository->create([
            'task_id' => $task->id,
            'user_id' => Auth::id() ?? $task->creator_id,
            'action'  => 'created',
        ]);
    }

    public function logUpdated(Task $task): void
    {
        $user = Auth::user() ?? $task->creator;
        $original = $task->getOriginal();
        $changes = [];

        foreach ($task->getChanges() as $field => $newValue) {
            if ($field === 'updated_at') {
                continue;
            }

            $oldValue = $original[$field] ?? null;

            $old = is_scalar($oldValue) ? (string) $oldValue : json_encode($oldValue);
            $new = is_scalar($newValue) ? (string) $newValue : json_encode($newValue);

            $changes[] = "$field: '$old' → '$new'";
        }

        if (!empty($changes)) {
            $this->logRepository->create([
                'task_id' => $task->id,
                'user_id' => $user?->id,
                'action'  => 'updated',
                'details' => [
                    'changes_field' => implode(', ', $changes),
                    'changes_relation' => null,
                    'changes_other' => null,
                    'usersId' => null
                ]
            ]);
        }
    }

    public function logRelationChange(Task $task, string $relation, string $action, int|array $relatedIds): void
    {
        $relatedIds = is_array($relatedIds) ? $relatedIds : [$relatedIds];

        $users = $this->userRepository->select(['id, name'])->whereIn('id', $relatedIds)->get();

        $this->logRepository->create([
            'task_id' => $task->id,
            'user_id' => Auth::id() ?? $task->creator_id,
            'action'  => $action,
            'details' => [
                'changes_field' => null,
                'changes_relation' => null,
                'changes_other' => $relation,
                'users' => $users->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                    ];
                })
            ]
        ]);
    }

    public function logCustom(Task $task, string $action, string $text = null, ?int $userId = null): void
    {
        $this->logRepository->create([
            'task_id' => $task->id,
            'user_id' => $userId ?? Auth::id(),
            'action'  => $action,
            'details' => [
                'changes_field' => null,
                'changes_relation' => null,
                'changes_other' => $text,
                'usersId' => null
            ],
        ]);
    }
}
