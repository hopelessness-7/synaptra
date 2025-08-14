<?php

namespace Modules\Common\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Modules\Common\Application\UseCases\FinishOnboarding;
use Illuminate\Http\RedirectResponse;

class FinishOnboardingController extends Controller
{
    public function __invoke(FinishOnboarding $finishOnboarding): RedirectResponse
    {
        $finishOnboarding->execute();
        return redirect()->route('dashboard')->with('success', 'Welcome, and good luck with your work!');
    }
}
