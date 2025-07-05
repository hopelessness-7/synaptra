<?php

namespace App\Modules\Auth\Application\UseCases\User;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;

class Show
{
    public function __construct(
        private readonly UserRepository $userRepository,
    ){}

    public function execute($id): User
    {
        return $this->userRepository->find($id);
    }
}
