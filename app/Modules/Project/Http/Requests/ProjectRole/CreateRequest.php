<?php

namespace Modules\Project\Http\Requests\ProjectRole;

use App\Http\Request\BaseFormRequest;

class CreateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
