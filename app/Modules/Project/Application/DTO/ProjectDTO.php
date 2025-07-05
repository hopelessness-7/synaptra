<?php

namespace App\Modules\Project\Application\DTO;

use App\DTO\BaseDTO;
use App\Modules\Project\Domain\Enums\TypeProjectEnum;

class ProjectDTO extends BaseDTO
{
    public ?int $id;
    public string $name;
    public ?string $slug;
    public ?string $description;
    public ?string $git_repo_url;
    public string $type;
}
