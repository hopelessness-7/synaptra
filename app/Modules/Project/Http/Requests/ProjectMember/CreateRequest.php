<?php

namespace Modules\Project\Http\Requests\ProjectMember;

use App\Http\Request\BaseFormRequest;
use App\Modules\Project\Domain\Enums\GradeEnum;
use App\Modules\Project\Domain\Enums\SpecializationEnum;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'project_id'      => ['required', 'integer', 'exists:projects,id'],
            'user_id'         => ['required', 'integer', 'exists:users,id'],
            'grade'           => ['required', 'string', new Enum(GradeEnum::class)],
            'specialization'  => ['required', 'string', new Enum(SpecializationEnum::class)],
            'load'            => ['sometimes', 'numeric', 'max:255'],
            'is_available'    => ['sometimes', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
