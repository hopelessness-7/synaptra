<?php

namespace Modules\Auth\Infrastructure\Services;

use App\Models\User;
use App\Modules\AccessControl\Infrastructure\Repositories\Eloquent\RoleRepository;
use App\Modules\Auth\Application\DTO\Auth\UserRegisterDTO;
use App\Repositories\Eloquent\UserRepository;

class UserRegistrarService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly RoleRepository $roleRepository,
    ){}

    public function register(UserRegisterDTO $dto): User
    {
        $data = $dto->forUserCreation();
        $roleAdmin = $this->roleRepository->where('name', 'admin')->queryFirst();
        $data['role_id'] = $roleAdmin->id;

        return $this->userRepository->create($data);
    }
}
