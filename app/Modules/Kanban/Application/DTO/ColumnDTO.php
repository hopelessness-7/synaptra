<?php

namespace App\Modules\Kanban\Application\DTO;

use App\DTO\BaseDTO;

class ColumnDTO extends BaseDTO
{
    public int $board_id;
    public string $title;
    public string $position;
}
