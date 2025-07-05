<?php

namespace App\Modules\Auth\Application\UseCases\Auth;

use App\Modules\Auth\Infrastructure\Repositories\Eloquent\BlacklistRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

readonly class Logout
{
    public function __construct(
        private BlacklistRepository $blacklistRepository
    ){}

    public function execute(): void
    {
        $token = JWTAuth::getToken();
        $this->blacklistRepository->add($token, now()->addDays(7));
    }
}
