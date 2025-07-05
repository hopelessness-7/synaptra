<?php

namespace App\Modules\Project\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Project\Infrastructure\Models\ProjectRole;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;

class ProjectRoleRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;

   public function __construct(ProjectRole $model)
   {
       parent::__construct($model);
   }
}
