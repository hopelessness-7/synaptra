<?php

namespace Modules\Auth\Http\Middleware;

use App\Enums\UserStatusEnum;
use App\Modules\Auth\Infrastructure\Services\JwtTokenProtectionService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtTokenProtectionMiddleware
{
    public function __construct(
        protected JwtTokenProtectionService $protectionService
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::getToken();

            if (!$token) {
                return response()->json(['message' => 'Token not provided'], 401);
            }

            if (!$this->protectionService->validateToken($token)) {
                return response()->json(['message' => 'Invalid or revoked token'], 401);
            }

            JWTAuth::setToken($token)->authenticate();

        } catch (JWTException $e) {
            \Log::error($e->getMessage());
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

