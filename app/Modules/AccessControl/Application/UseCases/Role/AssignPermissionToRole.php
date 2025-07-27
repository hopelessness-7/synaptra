<?php

namespace App\Modules\AccessControl\Application\UseCases\Role;

use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\PermissionRepository;
use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\RoleRepository;
use Modules\AccessControl\Infrastructure\Models\Role;

class AssignPermissionToRole
{
    public function __construct(
        private readonly RoleRepository $roleRepository
    ){}

    public function execute(int $roleId, array $permissionIds): Role
    {
        $role = $this->roleRepository->find($roleId);
        return $this->roleRepository->attachRolePermission($role, $permissionIds);
    }
}
