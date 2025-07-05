<?php

namespace Modules\Kanban\Http\Requests\Column;

use App\Http\Request\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'board_id' => ['sometimes', 'integer', 'exists:boards'],
            'title' => ['sometimes', 'string'],
            'position' => ['sometimes', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
