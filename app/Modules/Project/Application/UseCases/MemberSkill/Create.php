<?php

namespace App\Modules\Project\Application\UseCases\MemberSkill;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\MemberSkillRepository;
use App\Traits\Crud\HandlesCreate;

class Create
{
    use HandlesCreate;

    public function __construct(
        private readonly MemberSkillRepository $repository
    ){}
}
