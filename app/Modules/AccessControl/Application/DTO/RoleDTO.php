<?php

namespace App\Modules\AccessControl\Application\DTO;

use App\DTO\BaseDTO;

class RoleDTO extends BaseDTO
{
    public ?int $id;
    public string $name;
    public ?string $slug;
    public ?string $description;
}
