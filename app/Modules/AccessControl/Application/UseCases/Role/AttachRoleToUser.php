<?php

namespace App\Modules\AccessControl\Application\UseCases\Role;

use App\Models\User;
use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\UserRepository;

class AttachRoleToUser
{
    public function __construct(
        private readonly RoleRepository $roleRepository,
        private readonly UserRepository $userRepository
    ){}

    public function execute(int $roleId, int $userId): User
    {
        $role = $this->roleRepository->find($roleId);
        return $this->userRepository->attachRoleToUser($role, $userId);
    }
}
