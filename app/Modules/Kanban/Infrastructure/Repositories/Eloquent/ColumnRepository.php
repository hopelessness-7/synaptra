<?php

namespace App\Modules\Kanban\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;
use Modules\Kanban\Infrastructure\Models\Column;

class ColumnRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;

    public function __construct(Column $model)
    {
        parent::__construct($model);
    }
}
