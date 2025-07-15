<?php

namespace App\Modules\Common\Application\UseCases;

use App\Models\User;
use BackedEnum;

class SaveOnboardingStep
{
    public function execute(User $user, BackedEnum $enum): void
    {
        $user->onboarding_step = $enum->value;
        $user->save();
    }
}
