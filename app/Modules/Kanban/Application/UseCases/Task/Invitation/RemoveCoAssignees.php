<?php

namespace App\Modules\Kanban\Application\UseCases\Task\Invitation;

use App\Modules\Kanban\Application\DTO\CoAssigneesDTO;
use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskRepository;
use Modules\Kanban\Infrastructure\Models\Task;

class RemoveCoAssignees
{
    public function __construct(
        private readonly TaskRepository $repository
    ){}

    public function execute(CoAssigneesDTO $dto): Task
    {
        return $this->repository->removeCoAssignees($dto->task, $dto->coAssignees);
    }
}
