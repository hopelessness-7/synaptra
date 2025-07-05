<?php

namespace Modules\Kanban\Http\Controllers\Api\V1;

use App\Http\Controllers\CrudApiController;
use App\Modules\Kanban\Application\DTO\TaskDTO;
use App\Modules\Kanban\Application\UseCases\Task\Crud\Create;
use App\Modules\Kanban\Application\UseCases\Task\Crud\Delete;
use App\Modules\Kanban\Application\UseCases\Task\Crud\Get;
use App\Modules\Kanban\Application\UseCases\Task\Crud\Show;
use App\Modules\Kanban\Application\UseCases\Task\Crud\Update;
use Modules\Kanban\Http\Requests\Task\CreateRequest;
use Modules\Kanban\Http\Requests\Task\UpdateRequest;
use Modules\Kanban\Http\Resources\TaskResource;

class TaskController extends CrudApiController
{
    public function __construct(Get $get, Show $show, Create $create, Update $update, Delete $delete)
    {
        parent::__construct($get, $show, $create, $update, $delete);

        $this->dto = TaskDTO::class;
        $this->resourceClass = TaskResource::class;
        $this->createRequestClass = CreateRequest::class;
        $this->updateRequestClass = UpdateRequest::class;
    }
}
