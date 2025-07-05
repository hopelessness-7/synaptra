<?php

namespace App\Modules\Project\Application\DTO;

class MemberSkillDTO
{
    public ?int $id;
    public int $member_id;
    public string $skill;
    public ?int $level;
}
