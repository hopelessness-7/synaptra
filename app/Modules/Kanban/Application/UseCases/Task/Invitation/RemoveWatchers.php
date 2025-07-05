<?php

namespace App\Modules\Kanban\Application\UseCases\Task\Invitation;

use App\Modules\Kanban\Application\DTO\WatchersDTO;
use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\TaskRepository;
use Modules\Kanban\Infrastructure\Models\Task;

class RemoveWatchers
{
    public function __construct(
        private readonly TaskRepository $repository
    ){}

    public function execute(WatchersDTO $dto): Task
    {
        return $this->repository->removeWatchers($dto->task, $dto->watchers);
    }
}
