<?php

namespace App\Modules\Kanban\Application\UseCases\Task\Relationships;

use App\Modules\Kanban\Application\DTO\RelatedDTO;
use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskRepository;
use Modules\Kanban\Infrastructure\Models\Task;

class HandleRelationAction
{
    public function __construct(
        private readonly TaskRepository $repository,
    ){}

    public function execute(RelatedDTO $dto): Task
    {
        return $this->repository->{$dto->relatedAction->methodName()}($dto->task, $dto->relatedTaskIds);
    }
}
