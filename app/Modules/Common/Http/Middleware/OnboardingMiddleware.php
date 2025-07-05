<?php

namespace Modules\Common\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnboardingMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if ($user) {
            $step = $user->onboarding_step;

            if (is_null($step) || $step !== 'finish') {
                if (!str_starts_with($request->path(), 'onboarding')) {
                    return redirect()->route('onboarding.step', ['step' => $step ?? 'welcome']);
                }
            }
        }

        return $next($request);
    }

}
