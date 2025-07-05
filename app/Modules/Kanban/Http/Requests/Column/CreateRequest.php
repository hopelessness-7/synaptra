<?php

namespace Modules\Kanban\Http\Requests\Column;

use App\Http\Request\BaseFormRequest;

class CreateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'board_id' => ['required', 'integer', 'exists:boards,id'],
            'title' => ['required', 'string'],
            'position' => ['required', 'integer'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
