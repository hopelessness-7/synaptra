<?php

namespace App\Modules\Kanban\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;
use Illuminate\Support\Facades\DB;
use Modules\Kanban\Infrastructure\Models\Column;

class ColumnRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;

    public function __construct(Column $model)
    {
        parent::__construct($model);
    }

    public function createDefaultColumns(int $boardId): void
    {
        $columns = [];

        foreach (['To Do', 'In Progress', 'Done'] as $i => $name) {
            $columns[] = [
                'board_id' => $boardId,
                'name' => $name,
                'position' => $i + 1,
            ];
        }

        DB::table('columns')->insert($columns);
    }
}
