<?php

namespace App\Modules\Project\Application\UseCases\MemberSkill;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\MemberSkillRepository;
use App\Traits\Crud\HandlesGet;

class Get
{
    use HandlesGet;

    public function __construct(
        private readonly MemberSkillRepository $repository
    ){}
}
