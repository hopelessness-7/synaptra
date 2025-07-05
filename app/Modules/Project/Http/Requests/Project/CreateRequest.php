<?php

namespace Modules\Project\Http\Requests\Project;

use App\Http\Request\BaseFormRequest;
use App\Modules\Project\Domain\Enums\TypeProjectEnum;
use Illuminate\Validation\Rules\Enum;

class CreateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'          => ['required','string', 'max:255'],
            'slug'          => ['sometimes', 'string', 'max:255'],
            'description'   => ['sometimes', 'string'],
            'git_repo_url'  => ['sometimes', 'string'],
            'type'          => ['sometimes', 'string', new Enum(TypeProjectEnum::class)]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
