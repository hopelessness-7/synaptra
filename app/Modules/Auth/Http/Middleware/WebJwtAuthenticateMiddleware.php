<?php

namespace Modules\Auth\Http\Middleware;

use App\Enums\UserStatusEnum;
use App\Modules\Auth\Infrastructure\Services\JwtTokenProtectionService;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class WebJwtAuthenticateMiddleware
{
    public function __construct(
        protected JwtTokenProtectionService $protectionService,
    ) {}

    public function handle(Request $request, Closure $next): RedirectResponse|Response
    {
        $token = $request->cookie('token');

        if (!$token) {
            return $this->redirectWithErrors('Your session has expired, please sign in again');
        }

        if (!$this->protectionService->validateToken($token)) {
            return $this->redirectWithErrors('Invalid token, please sign in again');
        }

        $user = JWTAuth::setToken($token)->authenticate();

        if (!$user) {
            return $this->redirectWithErrors('User not found');
        }

        Auth::login($user);

        if (auth()->user()->status === UserStatusEnum::Blocked) {
            return $this->redirectWithErrors('User is blocked');
        }

        return $next($request);
    }

    private function redirectWithErrors(string $error): RedirectResponse
    {
        return redirect()->route('login.view')->withErrors(['auth' => $error])->withoutCookie('token');
    }
}
