<?php

namespace App\Modules\Project\Application\UseCases\MemberSkill;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\MemberSkillRepository;
use App\Traits\Crud\HandlesRead;

class Show
{
    use HandlesRead;

    public function __construct(
        private readonly MemberSkillRepository $repository
    ){}
}
