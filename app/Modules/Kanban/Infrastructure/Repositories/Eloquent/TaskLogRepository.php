<?php

namespace App\Modules\Kanban\Infrastructure\Repositories\Eloquent;

use App\Repositories\Eloquent\BaseRepository;
use Modules\Kanban\Infrastructure\Models\TaskLog;

class TaskLogRepository extends BaseRepository
{
    public function __construct(TaskLog $model)
    {
        parent::__construct($model);
    }
}
