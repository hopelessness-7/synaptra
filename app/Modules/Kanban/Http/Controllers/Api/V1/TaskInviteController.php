<?php

namespace Modules\Kanban\Http\Controllers\Api\V1;

use App\Http\Controllers\MainApiController;
use App\Modules\Kanban\Application\DTO\CoAssigneesDTO;
use App\Modules\Kanban\Application\DTO\WatchersDTO;
use App\Modules\Kanban\Application\UseCases\Task\Invitation\AddCoAssignees;
use App\Modules\Kanban\Application\UseCases\Task\Invitation\AddWatchers;
use App\Modules\Kanban\Application\UseCases\Task\Invitation\RemoveCoAssignees;
use App\Modules\Kanban\Application\UseCases\Task\Invitation\RemoveWatchers;
use Illuminate\Http\JsonResponse;
use Modules\Kanban\Http\Requests\Task\InviteRequest;
use Modules\Kanban\Http\Resources\TaskResource;
use Modules\Kanban\Infrastructure\Models\Task;

class TaskInviteController extends MainApiController
{
    public function addWatchers(InviteRequest $request, AddWatchers $watchers, Task $task): JsonResponse
    {
        $data = $request->validated();

        $dto = WatchersDTO::fromArray([
            'task' => $task,
            'watchers' => $data->users,
        ]);

        return $this->success(TaskResource::make($watchers->execute($dto))->resolve());
    }

    public function addCoAssignees(InviteRequest $request, AddCoAssignees $assignees, Task $task): JsonResponse
    {
        $data = $request->validated();

        $dto = CoAssigneesDTO::fromArray([
            'task' => $task,
            'coAssignees' => $data->users,
        ]);

        return $this->success(TaskResource::make($assignees->execute($dto))->resolve());
    }

    public function removeWatchers(InviteRequest $request, RemoveWatchers $watchers, Task $task): JsonResponse
    {
        $data = $request->validated();

        $dto = WatchersDTO::fromArray([
            'task' => $task,
            'watchers' => $data->users,
        ]);

        return $this->success(TaskResource::make($watchers->execute($dto))->resolve());
    }

    public function removeCoAssignees(InviteRequest $request, RemoveCoAssignees $assignees, Task $task): JsonResponse
    {
        $data = $request->validated();

        $dto = CoAssigneesDTO::fromArray([
            'task' => $task,
            'coAssignees' => $data->users,
        ]);

        return $this->success(TaskResource::make($assignees->execute($dto))->resolve());
    }
}
