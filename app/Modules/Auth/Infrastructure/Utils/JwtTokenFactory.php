<?php

namespace App\Modules\Auth\Infrastructure\Utils;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtTokenFactory
{
    public static function makeForUser(User $user): string
    {
        return JWTAuth::fromUser($user);
    }
}
