<?php

namespace Modules\AccessControl\Http\Controllers\Api\V1;

use App\Http\Controllers\CrudApiController;
use App\Modules\AccessControl\Application\DTO\RoleDTO;
use App\Modules\AccessControl\Application\UseCases\Role\AssignPermissionToRole;
use App\Modules\AccessControl\Application\UseCases\Role\Create;
use App\Modules\AccessControl\Application\UseCases\Role\Delete;
use App\Modules\AccessControl\Application\UseCases\Role\Get;
use App\Modules\AccessControl\Application\UseCases\Role\Show;
use App\Modules\AccessControl\Application\UseCases\Role\Update;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\AccessControl\Http\Requests\Role\CreateRequest;
use Modules\AccessControl\Http\Requests\Role\UpdateRequest;
use Modules\AccessControl\Http\Resources\RoleResource;

class RoleController extends CrudApiController
{
    public function __construct(
        Get $get,
        Show $show,
        Create $create,
        Update $update,
        Delete $delete,
        private readonly AssignPermissionToRole $assignPermissionToRole,
    ){
        parent::__construct($get, $show, $create, $update, $delete);

        $this->dto = RoleDTO::class;
        $this->resourceClass = RoleResource::class;
        $this->createRequestClass = CreateRequest::class;
        $this->updateRequestClass = UpdateRequest::class;


    }

    public function assignPermissionToRole(Request $request, $roleId): JsonResponse
    {
        $role = $this->assignPermissionToRole->execute($roleId, $request->permissions);
        return $this->success(RoleResource::make($role)->resolve());
    }
}
