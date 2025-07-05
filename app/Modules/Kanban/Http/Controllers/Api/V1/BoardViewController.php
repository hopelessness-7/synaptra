<?php

namespace Modules\Kanban\Http\Controllers\Api\V1;

use App\Http\Controllers\MainApiController;
use App\Modules\Kanban\Application\UseCases\Board\GetView;
use Illuminate\Http\JsonResponse;
use Modules\Kanban\Http\Resources\BoardViewResource;
use Modules\Kanban\Infrastructure\Exceptions\BoardNotFoundException;
use Modules\Kanban\Infrastructure\Models\Board;

class BoardViewController extends MainApiController
{
    /**
     * @throws BoardNotFoundException
     */
    public function __invoke(GetView $view, Board $board): JsonResponse
    {
        return $this->success([
            ...BoardViewResource::make($view->execute($board))->resolve()
        ]);
    }
}
