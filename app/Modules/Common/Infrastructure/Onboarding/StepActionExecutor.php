<?php

namespace App\Modules\Common\Infrastructure\Onboarding;

use App\DTO\BaseDTO;
use App\Models\User;
use App\Modules\Common\Domain\Enums\OnboardingStep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StepActionExecutor
{
    private array $entityToModuleMap = [
        'Project' => 'Project',
        'Board' => 'Kanban',
        'Role' => 'Project',
    ];

    public function execute(string $step, Request $request): Model
    {
        $entity = $this->resolveEntityFromStep($step);
        $module = $this->entityToModuleMap[$entity] ?? throw new \RuntimeException("Module not found for entity: $entity");

        $dtoClass = "\App\Modules\\{$module}\Application\DTO\\{$entity}DTO";
        $useCaseClass = "\App\Modules\\{$module}\Application\UseCases\\{$entity}\Create";

        if (!class_exists($dtoClass) || !class_exists($useCaseClass)) {
            throw new \RuntimeException("DTO or UseCase not found for step: $step");
        }

        $dto = $this->buildDTO($dtoClass, $request);
        return app($useCaseClass)->create($dto);
    }

    private function resolveEntityFromStep(string $step): string
    {
        return match ($step) {
            OnboardingStep::CreateProject->value => 'Project',
            OnboardingStep::CreateBoard->value => 'Board',
            OnboardingStep::CreateRoles->value => 'Role',
            default => throw new \InvalidArgumentException("Unknown step: $step"),
        };
    }

    private function buildDTO(string $dtoClass, Request $request): BaseDTO
    {
        return $dtoClass::fromRequest($request);
    }
}
