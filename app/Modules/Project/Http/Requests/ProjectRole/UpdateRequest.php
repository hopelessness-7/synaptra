<?php

namespace Modules\Project\Http\Requests\ProjectRole;

use App\Http\Request\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'         => 'nullable|string|max:255',
            'description'  => 'nullable|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
