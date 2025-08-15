<?php

namespace App\Modules\Kanban\Application\DTO;

use App\DTO\BaseDTO;

class BoardDTO extends BaseDTO
{
    public ?int $id;
    public int $project_id;

    public string $title;
    public ?string $description;

    public ?bool $is_default;
    public ?bool $is_active;
}
