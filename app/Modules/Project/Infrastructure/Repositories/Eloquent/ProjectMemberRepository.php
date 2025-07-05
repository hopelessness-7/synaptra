<?php

namespace App\Modules\Project\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Project\Infrastructure\Models\ProjectMember;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;

class ProjectMemberRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;
   public function __construct(ProjectMember $model)
   {
       parent::__construct($model);
   }
}
