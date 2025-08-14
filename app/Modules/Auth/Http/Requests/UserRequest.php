<?php

namespace Modules\Auth\Http\Requests;

use App\Enums\UserStatusEnum;
use App\Modules\Common\Domain\Enums\OnboardingStep;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'email'],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'status' => ['sometimes', new Enum(UserStatusEnum::class)],
            'onboarding_step' => ['sometimes', new Enum(OnboardingStep::class)],
        ];
    }
}
