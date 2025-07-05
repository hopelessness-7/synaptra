<?php

namespace Modules\Kanban\Http\Controllers\Api\V1;

use App\Http\Controllers\MainApiController;
use App\Modules\Kanban\Application\DTO\RelatedDTO;
use App\Modules\Kanban\Application\UseCases\Task\Relationships\HandleRelationAction;
use App\Modules\Kanban\Domain\Enums\RelationActionEnum;
use Illuminate\Http\JsonResponse;
use Modules\Kanban\Http\Requests\Task\RelatedRequest;
use Modules\Kanban\Http\Resources\TaskResource;
use Modules\Kanban\Infrastructure\Models\Task;

class TaskRelationsController extends MainApiController
{
    public function __invoke(HandleRelationAction $handleRelation, RelatedRequest $request, Task $task, string $action, string $type): JsonResponse
    {
        $dto = RelatedDTO::fromArray([
            'task'           => $task,
            'relatedTaskIds' => $request->validated(),
            'relatedAction'  => RelationActionEnum::fromParts($action, $type),
        ]);

        return $this->success(TaskResource::make($handleRelation->execute($dto))->resolve());
    }
}
