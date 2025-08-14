<?php

namespace Modules\AccessControl\Domain\Services;

use App\Models\User;

class AccessControlService
{
    public function hasRole(User $user, string $roleSlugOrName): bool
    {
        return $user->hasRole($roleSlugOrName);
    }

    public function hasAnyRole(User $user, array $roleSlugsOrNames): bool
    {
        return $user->hasAnyRole($roleSlugsOrNames);
    }

    public function hasPermission(User $user, string $permissionSlugOrName): bool
    {
        return $user->hasPermission($permissionSlugOrName);
    }

    public function hasAnyPermission(User $user, array $permissionSlugsOrNames): bool
    {
        return $user->hasAnyPermission($permissionSlugsOrNames);
    }
}
