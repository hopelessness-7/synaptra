<?php

namespace Modules\Kanban\Http\Controllers\Api\V1;

use App\Http\Controllers\CrudApiController;
use App\Modules\Kanban\Application\DTO\ColumnDTO;
use App\Modules\Kanban\Application\UseCases\Column\Create;
use App\Modules\Kanban\Application\UseCases\Column\Delete;
use App\Modules\Kanban\Application\UseCases\Column\Get;
use App\Modules\Kanban\Application\UseCases\Column\Show;
use App\Modules\Kanban\Application\UseCases\Column\Update;
use Modules\Kanban\Http\Requests\Column\CreateRequest;
use Modules\Kanban\Http\Requests\Column\UpdateRequest;
use Modules\Kanban\Http\Resources\ColumnResource;

class ColumnController extends CrudApiController
{
    public function __construct(Get $get, Show $show, Create $create, Update $update, Delete $delete)
    {
        parent::__construct($get, $show, $create, $update, $delete);

        $this->dto = ColumnDTO::class;
        $this->resourceClass = ColumnResource::class;
        $this->createRequestClass = CreateRequest::class;
        $this->updateRequestClass = UpdateRequest::class;
    }
}
