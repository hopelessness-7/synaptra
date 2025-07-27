<?php

namespace Modules\AccessControl\Http\Controllers\Api\V1;

use App\Http\Controllers\MainApiController;
use App\Modules\AccessControl\Application\UseCases\Role\AttachRoleToUser;
use Illuminate\Http\JsonResponse;
use App\Http\Resource\UserShowResource;

class UserController extends MainApiController
{
    public function __construct(
        private readonly AttachRoleToUser $attachRoleToUser,
    ){}

    public function attachRoleToUser(int $roleId, int $userId): JsonResponse
    {
        $user = $this->attachRoleToUser->execute($roleId, $userId);
        
        return $this->success(UserShowResource::make($user)->resolve());
    }
}
