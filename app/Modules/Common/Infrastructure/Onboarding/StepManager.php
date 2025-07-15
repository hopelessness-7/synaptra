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
        $roleMode = $request->get('role_mode', 'standard');
        $nextStep = $this->determineNextStep($currentStep, $roleMode);
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

    private function determineNextStep(string $step, string $roleMode): OnboardingStep
    {


        return match ($step) {
            OnboardingStep::Welcome->value => OnboardingStep::CreateProject,
            OnboardingStep::CreateProject->value => OnboardingStep::CreateBoard,
            OnboardingStep::CreateBoard->value => OnboardingStep::CreateRoles,
            OnboardingStep::CreateRoles->value => $roleMode === 'custom'
                ? OnboardingStep::CreateRolesCustom
                : OnboardingStep::InviteTeam,
            OnboardingStep::EditRolesStandard->value,
            OnboardingStep::CreateRolesCustom->value => OnboardingStep::InviteTeam,
            default => null,
        };
    }
}
