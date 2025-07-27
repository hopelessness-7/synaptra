<?php

namespace Modules\AccessControl\Http\Requests\Role;

use App\Http\Request\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['sometimes', 'string', 'max:255'],
            'slug'        => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
