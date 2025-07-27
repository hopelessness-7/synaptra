<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait HasRolesAndPermissions
{
    public function hasRole(string $slugOrName): bool
    {
        return $this->role
            && ($this->role->slug === $slugOrName || $this->role->name === $slugOrName);
    }

    public function hasAnyRole(array $roleSlugsOrNames): bool
    {
        if (!$this->role) {
            return false;
        }

        return in_array($this->role->slug, $roleSlugsOrNames)
            || in_array($this->role->name, $roleSlugsOrNames);
    }

    public function hasPermission(string $permissionSlugOrName): bool
    {
        return $this->checkPermissions($permissionSlugOrName);
    }

    public function hasAnyPermission(array $permissionSlugsOrNames): bool
    {
        return $this->checkPermissions($permissionSlugsOrNames);
    }

    protected function checkPermissions(array|string $permissionSlugOrNames): bool
    {
        if (!$this->role) {
            return false;
        }

        $permissions = is_array($permissionSlugOrNames) ? $permissionSlugOrNames : [$permissionSlugOrNames];

        if ($this->role->relationLoaded('permissions')) {
            return $this->role->permissions->contains(function ($permission) use ($permissions) {
                return in_array($permission->slug, $permissions)
                    || in_array($permission->name, $permissions);
            });
        }

        return $this->role
            ->permissions()
            ->where(function ($query) use ($permissions) {
                $query->whereIn('slug', $permissions)
                    ->orWhereIn('name', $permissions);
            })
            ->exists();
    }
}
