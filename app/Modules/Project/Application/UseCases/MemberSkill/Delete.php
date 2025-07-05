<?php

namespace App\Modules\Project\Application\UseCases\MemberSkill;

use App\Modules\Project\Infrastructure\Repositories\Eloquent\MemberSkillRepository;
use App\Traits\Crud\HandlesDelete;

class Delete
{
    use HandlesDelete;

    public function __construct(
        private readonly MemberSkillRepository $repository
    ){}
}
