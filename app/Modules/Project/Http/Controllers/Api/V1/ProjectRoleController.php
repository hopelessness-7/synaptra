<?php

namespace Modules\Project\Http\Controllers\Api\V1;

use App\Http\Controllers\CrudApiController;
use App\Modules\Project\Application\DTO\ProjectRoleDTO;
use App\Modules\Project\Application\UseCases\ProjectRole\Get;
use App\Modules\Project\Application\UseCases\ProjectRole\Show;
use App\Modules\Project\Application\UseCases\ProjectRole\Create;
use App\Modules\Project\Application\UseCases\ProjectRole\Update;
use App\Modules\Project\Application\UseCases\ProjectRole\Delete;
use Modules\Project\Http\Requests\ProjectRole\CreateRequest;
use Modules\Project\Http\Requests\ProjectRole\UpdateRequest;
use Modules\Project\Http\Resources\ProjectRoleResource;

class ProjectRoleController extends CrudApiController
{
    public function __construct(Get $get, Show $show, Create $create, Update $update, Delete $delete)
    {
        parent::__construct($get, $show, $create, $update, $delete);

        $this->dto = ProjectRoleDTO::class;
        $this->resourceClass = ProjectRoleResource::class;
        $this->createRequestClass = CreateRequest::class;
        $this->updateRequestClass = UpdateRequest::class;
    }
}
