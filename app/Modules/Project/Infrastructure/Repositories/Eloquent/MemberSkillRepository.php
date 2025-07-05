<?php

namespace App\Modules\Project\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Project\Infrastructure\Models\MemberSkill;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;

class MemberSkillRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;
   public function __construct(MemberSkill $model)
   {
       parent::__construct($model);
   }
}
