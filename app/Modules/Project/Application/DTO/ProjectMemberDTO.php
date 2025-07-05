<?php

namespace App\Modules\Project\Application\DTO;

use App\DTO\BaseDTO;
use App\Modules\Project\Domain\Enums\GradeEnum;
use App\Modules\Project\Domain\Enums\SpecializationEnum;

class ProjectMemberDTO extends BaseDTO
{
    public ?int $id;
    public  int $project_id;
    public  int $user_id;
    public  int $role_id;
    public  GradeEnum $grade;
    public  SpecializationEnum $specialization;
    public  ?float $load;
    public  ?bool $is_available;
}
