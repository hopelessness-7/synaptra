<?php

namespace Modules\Common\Http\Controllers\Web;

use App\Http\Controllers\Controller;

class OnboardingController extends Controller
{
    public function __invoke($step)
    {
        return view('onboarding.' . $step);
    }
}
