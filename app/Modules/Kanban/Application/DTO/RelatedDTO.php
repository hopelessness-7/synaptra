<?php

namespace App\Modules\Kanban\Application\DTO;

use App\DTO\BaseDTO;
use App\Modules\Kanban\Domain\Enums\RelationActionEnum;
use Modules\Kanban\Infrastructure\Models\Task;

class RelatedDTO extends BaseDTO
{
    public Task $task;
    public array|int $relatedTaskIds;
    public RelationActionEnum $relatedAction;
}
