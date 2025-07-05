<?php

namespace App\Modules\Auth\Http\Middleware;

use App\Enums\UserStatusEnum;
use App\Modules\Auth\Infrastructure\Services\JwtTokenProtectionService;
use Closure;
use Illuminate\Http\Request;
use Modules\Auth\Infrastructure\Exceptions\AuthenticationException;
use Modules\Auth\Infrastructure\Exceptions\InvalidTokenException;
use Modules\Auth\Infrastructure\Exceptions\TokenNotProvidedException;
use Modules\Auth\Infrastructure\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthApiMiddleware
{
    public function __construct(
        protected JwtTokenProtectionService $protectionService,
    ) {}

    /**
     * @throws TokenNotProvidedException|UnauthorizedException|InvalidTokenException|AuthenticationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                throw new TokenNotProvidedException();
            }

            if (!$this->protectionService->validateToken($token)) {
                throw new InvalidTokenException();
            }

            JWTAuth::setToken($token)->authenticate();

            if (auth()->user()->status === UserStatusEnum::Blocked) {
                throw new AuthenticationException('User is blocked');
            }

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            \Log::error('JWT Exception: ' . $e->getMessage());
            throw new UnauthorizedException();
        }

        return $next($request);
    }
}
