<?php

namespace App\Modules\AccessControl\Infrastructure\Repositories\Eloquent;

use App\Contracts\DTORepositoryInterface;
use App\DTO\BaseDTO;
use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Traits\HandlesDTO;
use Illuminate\Database\Eloquent\Model;
use Modules\AccessControl\Infrastructure\Models\Role;

class RoleRepository extends BaseRepository implements DTORepositoryInterface
{
    use HandlesDTO;

    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function attachRolePermission(Role $role, array $permissionIds): Role
    {
        $permissions = app(PermissionRepository::class)->findMany($permissionIds)->pluck('id')->toArray();
        $role->permissions()->sync($permissions);
        return $role;
    }
}
