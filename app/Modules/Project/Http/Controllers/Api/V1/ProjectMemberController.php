<?php

namespace Modules\Project\Http\Controllers\Api\V1;

use App\Http\Controllers\CrudApiController;
use App\Modules\Project\Application\DTO\ProjectMemberDTO;
use App\Modules\Project\Application\UseCases\ProjectMember\Get;
use App\Modules\Project\Application\UseCases\ProjectMember\Show;
use App\Modules\Project\Application\UseCases\ProjectMember\Create;
use App\Modules\Project\Application\UseCases\ProjectMember\Update;
use App\Modules\Project\Application\UseCases\ProjectMember\Delete;
use Modules\Project\Http\Requests\ProjectMember\CreateRequest;
use Modules\Project\Http\Requests\ProjectMember\UpdateRequest;
use Modules\Project\Http\Resources\ProjectMemberResource;

class ProjectMemberController extends CrudApiController
{
    public function __construct(Get $get, Show $show, Create $create, Update $update, Delete $delete)
    {
        parent::__construct($get, $show, $create, $update, $delete);

        $this->dto = ProjectMemberDTO::class;
        $this->resourceClass = ProjectMemberResource::class;
        $this->createRequestClass = CreateRequest::class;
        $this->updateRequestClass = UpdateRequest::class;
    }
}
