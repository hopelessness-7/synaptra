<?php

namespace App\Modules\Project\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Modules\Project\Infrastructure\Models\Project;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;

class ProjectRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;
   public function __construct(Project $model)
   {
       parent::__construct($model);
   }

    public function countProjectsForUser(int $userId): int
    {
        return $this->model->whereHas('members', fn($q) => $q->where('user_id', $userId))->count();
    }
}
