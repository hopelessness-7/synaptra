<?php

namespace Modules\Kanban\Http\Requests\Task;

use App\Http\Request\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'column_id' => ['sometimes', 'exists:columns'],
            'assignee_id' => ['sometimes', 'exists:users'],
            'creator_id' => ['sometimes', 'exists:users'],
            'title' => ['sometimes'],
            'description' => ['sometimes'],
            'position' => ['sometimes', 'integer'],
            'status' => ['sometimes'],
            'priority' => ['sometimes'],
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
