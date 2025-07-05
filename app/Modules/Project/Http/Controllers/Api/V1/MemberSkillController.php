<?php

namespace Modules\Project\Http\Controllers\Api\V1;

use App\Http\Controllers\CrudApiController;
use App\Modules\Project\Application\DTO\MemberSkillDTO;
use App\Modules\Project\Application\UseCases\MemberSkill\Get;
use App\Modules\Project\Application\UseCases\MemberSkill\Show;
use App\Modules\Project\Application\UseCases\MemberSkill\Create;
use App\Modules\Project\Application\UseCases\MemberSkill\Update;
use App\Modules\Project\Application\UseCases\MemberSkill\Delete;
use Modules\Project\Http\Requests\MemberSkill\CreateRequest;
use Modules\Project\Http\Requests\MemberSkill\UpdateRequest;
use Modules\Project\Http\Resources\MemberSkillResource;

class MemberSkillController extends CrudApiController
{
    public function __construct(Get $get, Show $show, Create $create, Update $update, Delete $delete)
    {
        parent::__construct($get, $show, $create, $update, $delete);

        $this->dto = MemberSkillDTO::class;
        $this->resourceClass = MemberSkillResource::class;
        $this->createRequestClass = CreateRequest::class;
        $this->updateRequestClass = UpdateRequest::class;
    }
}
