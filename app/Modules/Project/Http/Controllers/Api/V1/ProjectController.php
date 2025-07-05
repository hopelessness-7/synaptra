<?php

namespace Modules\Project\Http\Controllers\Api\V1;

use App\Http\Controllers\CrudApiController;
use App\Modules\Project\Application\DTO\ProjectDTO;
use App\Modules\Project\Application\UseCases\Project\Create;
use App\Modules\Project\Application\UseCases\Project\Delete;
use App\Modules\Project\Application\UseCases\Project\Get;
use App\Modules\Project\Application\UseCases\Project\Show;
use App\Modules\Project\Application\UseCases\Project\Update;
use Modules\Project\Http\Requests\Project\CreateRequest;
use Modules\Project\Http\Requests\Project\UpdateRequest;
use Modules\Project\Http\Resources\ProjectResource;

class ProjectController extends CrudApiController
{
    public function __construct(Get $get, Show $show, Create $create, Update $update, Delete $delete)
    {
        parent::__construct($get, $show, $create, $update, $delete);

        $this->dto = ProjectDTO::class;
        $this->resourceClass = ProjectResource::class;
        $this->createRequestClass = CreateRequest::class;
        $this->updateRequestClass = UpdateRequest::class;
    }
}
