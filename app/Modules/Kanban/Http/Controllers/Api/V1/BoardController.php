<?php

namespace Modules\Kanban\Http\Controllers\Api\V1;

use App\Http\Controllers\CrudApiController;
use App\Modules\Kanban\Application\DTO\BoardDTO;
use App\Modules\Kanban\Application\UseCases\Board\Get;
use App\Modules\Kanban\Application\UseCases\Board\Show;
use App\Modules\Kanban\Application\UseCases\Board\Create;
use App\Modules\Kanban\Application\UseCases\Board\Update;
use App\Modules\Kanban\Application\UseCases\Board\Delete;
use Modules\Kanban\Http\Requests\Board\CreateRequest;
use Modules\Kanban\Http\Requests\Board\UpdateRequest;
use Modules\Kanban\Http\Resources\BoardResource;

class BoardController extends CrudApiController
{
    public function __construct(Get $get, Show $show, Create $create, Update $update, Delete $delete)
    {
        parent::__construct($get, $show, $create, $update, $delete);

        $this->dto = BoardDTO::class;
        $this->resourceClass = BoardResource::class;
        $this->createRequestClass = CreateRequest::class;
        $this->updateRequestClass = UpdateRequest::class;
    }
}
