<?php

namespace Modules\Project\Http\Requests\ProjectMember;

use App\Http\Request\BaseFormRequest;
use App\Modules\Project\Domain\Enums\GradeEnum;
use App\Modules\Project\Domain\Enums\SpecializationEnum;
use Illuminate\Validation\Rules\Enum;

class UpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'project_id'      => ['sometimes', 'integer', 'exists:projects,id'],
            'user_id'         => ['sometimes', 'integer', 'exists:users,id'],
            'grade'           => ['sometimes', 'string', new Enum(GradeEnum::class)],
            'specialization'  => ['sometimes', 'string', new Enum(SpecializationEnum::class)],
            'load'            => ['sometimes', 'numeric', 'max:255'],
            'is_available'    => ['sometimes', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
