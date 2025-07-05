<?php

namespace Modules\Kanban\Infrastructure\Jobs;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\BoardRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Modules\Kanban\Infrastructure\Exceptions\BoardNotFoundException;

class RefreshBoardCacheJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected int $boardId;

    public function __construct(int $boardId)
    {
        $this->boardId = $boardId;
    }

    /**
     * @throws BoardNotFoundException
     */
    public function handle(BoardRepository $repository): void
    {
        Cache::tags(['boards', "board:{$this->boardId}"])
            ->forget("board:view:{$this->boardId}");

        $repository->getBoardView($this->boardId);
    }
}
