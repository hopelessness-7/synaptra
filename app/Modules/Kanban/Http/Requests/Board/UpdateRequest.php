<?php

namespace Modules\Kanban\Http\Requests\Board;

use App\Http\Request\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'project_id' => ['sometimes', 'integer', 'exists:projects'],
            'title' => ['sometimes', 'string'],
            'description' => ['sometimes', 'string'],
            'is_default' => ['sometimes','boolean'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
