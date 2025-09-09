<?php

namespace App\Modules\Auth\Application\UseCases\Auth;

use App\Models\User;
use App\Modules\Auth\Application\DTO\Auth\UserRegisterDTO;
use Modules\Auth\Infrastructure\Events\UserRegisteredEvent;
use Modules\Auth\Infrastructure\Services\UserRegistrarService;

readonly class Register
{
    public function __construct(
        private UserRegistrarService $registrar
    ){}

    public function execute(UserRegisterDTO $dto): User
    {
        $user = $this->registrar->register($dto);

        event(new UserRegisteredEvent($user));

        return $user;
    }
}
