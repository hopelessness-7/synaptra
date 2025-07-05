<?php

namespace App\Modules\Kanban\Application\DTO;

use App\DTO\BaseDTO;
use App\Modules\Kanban\Domain\Enums\PriorityEnum;
use App\Modules\Kanban\Domain\Enums\StatusEnum;

class TaskDTO extends BaseDTO
{
    public int $column_id;
    public int $position;

    public int $assignee_id;
    public int $creator_id;

    public string $title;
    public ?string $description;

    public ?StatusEnum $status;
    public ?PriorityEnum $priority;

    /** @var string|null Format: Y-m-d */
    public ?string $due_date;
    /** @var string|null Format: Y-m-d H:i:s */
    public ?string $started_at;
    /** @var string|null Format: Y-m-d H:i:s */
    public ?string $finished_at;
    /** @var int|null Format: hours */
    public ?int $estimated_time;
    /** @var int|null Format: hours */
    public ?int $spent_time;
}
