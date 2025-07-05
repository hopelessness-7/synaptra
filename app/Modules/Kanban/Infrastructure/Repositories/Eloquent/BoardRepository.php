<?php

namespace App\Modules\Kanban\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Traits\HandlesDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Modules\Kanban\Http\Resources\BoardViewResource;
use Modules\Kanban\Infrastructure\Exceptions\BoardNotFoundException;
use Modules\Kanban\Infrastructure\Models\Board;

class BoardRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;

    public function __construct(Board $model)
    {
        parent::__construct($model);
    }

    public function getBoardView(int $boardId): array
    {
        return Cache::tags(['boards', "board:$boardId"])
            ->remember("board:view:$boardId", now()->addHours(24), function () use ($boardId) {
                $board = $this->model->with('columns.tasks')->find($boardId);

                if (!$board) {
                    throw new BoardNotFoundException("Board not found");
                }

                return (new BoardViewResource($board))->resolve();
            });
    }

    public function getActiveOrDefaultBoards(int $userId): Collection
    {
        return $this->model
            ->select('id', 'title', 'is_default', 'is_active', 'project_id')
            ->whereHas('project.members', fn ($query) => $query->where('user_id', $userId))
            ->where(function ($query) {
                $query->where('is_active', true)
                    ->orWhere('is_default', true);
            })
            ->with(['project:id,name'])
            ->withCount('tasks')
            ->inRandomOrder()
            ->limit(3)
            ->get();
    }


    public function countActiveBoardsForUser(int $userId): int
    {
        return $this->model
            ->where('is_active', true)
            ->whereHas('project.members', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->count();
    }
}
