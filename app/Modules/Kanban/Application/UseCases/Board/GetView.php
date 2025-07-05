<?php

namespace App\Modules\Kanban\Application\UseCases\Board;

use App\Modules\Kanban\Infrastructure\Repositories\Eloquent\BoardRepository;
use Modules\Kanban\Infrastructure\Exceptions\BoardNotFoundException;
use Modules\Kanban\Infrastructure\Models\Board;

class GetView
{
    public function __construct(
        private readonly BoardRepository $boardRepository
    ){}

    /**
     * @throws BoardNotFoundException
     */
    public function execute(Board $board): array
    {
        return $this->boardRepository->getBoardView($board->id);
    }
}
