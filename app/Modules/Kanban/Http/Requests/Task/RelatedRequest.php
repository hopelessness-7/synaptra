<?php

namespace Modules\Kanban\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class RelatedRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'tasks'  => 'required|array',
            'tasks.*' => 'exists:tasks,id',
        ];
    }
}
