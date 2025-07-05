<?php

namespace App\Modules\Kanban\Application\DTO;

use App\DTO\BaseDTO;
use Modules\Kanban\Infrastructure\Models\Task;

class CoAssigneesDTO extends BaseDTO
{
    public Task $task;
    public array|int $coAssignees;
}
