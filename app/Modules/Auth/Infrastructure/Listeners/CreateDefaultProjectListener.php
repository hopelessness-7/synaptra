<?php

namespace Modules\Auth\Infrastructure\Listeners;

use App\Repositories\Eloquent\UserRepository;
use Modules\Auth\Infrastructure\Events\ProjectCreatedEvent;
use Modules\Auth\Infrastructure\Events\UserRegisteredEvent;

class CreateDefaultProjectListener
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ){}

    public function handle(UserRegisteredEvent $event): void
    {
        $project = $this->userRepository->createProjectWithRelation($event->user, [
            'name' => 'My First Project',
            'description' => 'Default project created automatically',
        ]);

        event(new ProjectCreatedEvent($project->id));
    }
}
