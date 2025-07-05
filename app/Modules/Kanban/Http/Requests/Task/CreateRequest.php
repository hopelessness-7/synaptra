<?php

namespace Modules\Kanban\Http\Requests\Task;

use App\Http\Request\BaseFormRequest;

class CreateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'column_id' => ['required', 'integer', 'exists:columns,id'],
            'assignee_id' => ['required', 'integer', 'exists:users,id'],
            'creator_id' => ['required', 'integer', 'exists:users,id'],
            'title' => ['required', 'string'],
            'description' => ['sometimes', 'string'],
            'position' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'priority' => ['required', 'string'],
            'due_date' => ['sometimes', 'date'],
            'started_at' => ['sometimes', 'date'],
            'finished_at' => ['sometimes', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
