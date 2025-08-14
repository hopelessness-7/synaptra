<?php

namespace Modules\AccessControl\Http\Controllers\Api\V1;

use App\Modules\AccessControl\Application\UseCases\Permission\Get;
use App\Modules\AccessControl\Application\UseCases\Permission\Show;
use Modules\AccessControl\Http\Resources\PermissionResource;
use App\Http\Controllers\ReadOnlyApiController;

class PermissionController extends ReadOnlyApiController
{
    public function __construct(Get $get, Show $show)
    {
        parent::__construct($get, $show);

        $this->resourceClass = PermissionResource::class;
    }
}
