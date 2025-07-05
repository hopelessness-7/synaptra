<?php

namespace App\Modules\Kanban\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;
use Modules\Kanban\Infrastructure\Models\TaskComment;

class TaskCommentRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;

    public function __construct(TaskComment $model)
    {
        parent::__construct($model);
    }

    public function countCommentsByUser(int $userId): int
    {
        return $this->model->where('user_id', $userId)->count();
    }
}
