<?php

namespace Modules\Auth\Infrastructure\Listeners;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\BoardRepository;
use App\Modules\Project\Infrastructure\Repositories\Eloquent\ProjectRepository;
use Modules\Auth\Infrastructure\Events\BoardCreatedEvent;
use Modules\Auth\Infrastructure\Events\ProjectCreatedEvent;

class CreateDefaultBoardListener
{
    public function __construct(
        private readonly BoardRepository $repository,
    ){}

    public function handle(ProjectCreatedEvent $event): void
    {
        $board = $this->repository->create([
            'title' => 'My First Board',
            'description' => 'Default board created automatically',
            'project_id' => $event->projectId,
        ]);

        event(new BoardCreatedEvent($board->id));
    }

}
