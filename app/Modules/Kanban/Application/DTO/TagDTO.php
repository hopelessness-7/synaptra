<?php

namespace App\Modules\Kanban\Application\DTO;

use App\DTO\BaseDTO;

class TagDTO extends BaseDTO
{
    public string $title;
    public string $color;
    public int $task_id;
}
