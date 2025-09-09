<?php

namespace Modules\Auth\Infrastructure\Events;

use App\Modules\Project\Infrastructure\Models\Project;

class ProjectCreatedEvent
{
    public function __construct(
        public int $projectId
    ){}
}
