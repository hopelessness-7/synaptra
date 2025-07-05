<?php

namespace Modules\Project\Http\Controllers\Api\V1;

use App\Http\Controllers\CrudApiController;
use App\Modules\Project\Application\DTO\MemberMetricDTO;
use App\Modules\Project\Application\UseCases\MemberMetric\Get;
use App\Modules\Project\Application\UseCases\MemberMetric\Show;
use App\Modules\Project\Application\UseCases\MemberMetric\Create;
use App\Modules\Project\Application\UseCases\MemberMetric\Update;
use App\Modules\Project\Application\UseCases\MemberMetric\Delete;
use Modules\Project\Http\Requests\MemberMetric\CreateRequest;
use Modules\Project\Http\Requests\MemberMetric\UpdateRequest;
use Modules\Project\Http\Resources\MemberMetricResource;

class MemberMetricController extends CrudApiController
{
    public function __construct(Get $get, Show $show, Create $create, Update $update, Delete $delete)
    {
        parent::__construct($get, $show, $create, $update, $delete);

        $this->dto = MemberMetricDTO::class;
        $this->resourceClass = MemberMetricResource::class;
        $this->createRequestClass = CreateRequest::class;
        $this->updateRequestClass = UpdateRequest::class;
    }
}
