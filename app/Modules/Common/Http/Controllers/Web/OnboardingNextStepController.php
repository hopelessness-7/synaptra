<?php

namespace Modules\Common\Http\Controllers\Web;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Common\Domain\Enums\OnboardingStep;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class OnboardingNextStepController extends Controller
{
    public function handle(Request $request, string $step)
    {
        $user = Auth::user();

        switch ($step) {
            case OnboardingStep::Welcome->value:
                $user->onboarding_step = OnboardingStep::CreateProject->value;
                $user->save();
                break;
            case OnboardingStep::CreateProject->value:
                $user->onboarding_step = OnboardingStep::CreateBoard->value;
                $user->save();
                break;
            case OnboardingStep::CreateBoard->value:
                $user->onboarding_step = OnboardingStep::CreateRoles->value;
                $user->save();
                break;
            case OnboardingStep::CreateRoles->value:

                if ($request->role_mode === 'custom') {
                    $user->onboarding_step = OnboardingStep::CreateRolesCustom->value;
                    $user->save();
                    break;
                }

                $user->onboarding_step = OnboardingStep::InviteTeam->value;
                $user->save();
                break;
            case OnboardingStep::CreateRolesCustom->value:
                $user->onboarding_step = OnboardingStep::InviteTeam->value;
                $user->save();
                break;
            case  OnboardingStep::EditRolesStandard->value:
                $user->onboarding_step = OnboardingStep::InviteTeam->value;
                $user->save();
                break;
            default:
                abort(404);
        }

        return redirect()->route('onboarding.step', ['step' => $user->onboarding_step]);
    }
}
