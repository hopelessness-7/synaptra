<?php

namespace Modules\Common\Http\Controllers\Web;


use App\Modules\Common\Infrastructure\Onboarding\StepManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OnboardingNextStepController extends Controller
{
    public function __construct(
        private readonly StepManager $manager
    ){}

    public function handle(Request $request, string $step): RedirectResponse
    {
        [$nextStep, $model] = $this->manager->handle($step, $request);
        return redirect()
            ->route('onboarding.step', ['step' => $nextStep])
            ->with('model', $model);
    }
}
