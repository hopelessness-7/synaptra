<?php

namespace App\Modules\Common\Infrastructure\Onboarding;

use App\Modules\Common\Application\UseCases\SaveOnboardingStep;
use App\Modules\Common\Domain\Enums\OnboardingStep;
use Illuminate\Http\Request;

class StepManager
{
    public function __construct(
        private readonly SaveOnboardingStep $saveOnboardingStep,
    ){}

    public function handle(string $currentStep, Request $request): array
    {
        $nextStep = $this->determineNextStep($currentStep);
        $model = null;

        if (!$nextStep) {
            throw new \InvalidArgumentException("Unknown onboarding step: {$currentStep}");
        }

        $this->saveOnboardingStep->execute(auth()->user(), $nextStep);

        if ($currentStep !== OnboardingStep::Welcome->value) {
            $model = app(StepActionExecutor::class)->execute($currentStep, $request);
        }

        return [$nextStep, $model];
    }

    private function determineNextStep(string $step): OnboardingStep
    {


        return match ($step) {
            OnboardingStep::Welcome->value => OnboardingStep::CreateProject,
            OnboardingStep::CreateProject->value => OnboardingStep::CreateBoard,
            OnboardingStep::CreateBoard->value => OnboardingStep::InviteTeam,
            OnboardingStep::InviteTeam->value, OnboardingStep::Finish->value => OnboardingStep::Finish,
            default => throw new \InvalidArgumentException("Unknown onboarding step: {$step}"),
        };
    }
}
