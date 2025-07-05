<?php

namespace Modules\Project\Http\Requests\MemberMetric;

use App\Http\Request\BaseFormRequest;

class CreateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'member_id'         => 'required|integer|exists:project_members,id',
            'tasks_completed'   => 'nullable|boolean',
            'avg_task_time'     => 'nullable|numeric',
            'total_work_time'   => 'nullable|numeric',
            'quality_score'     => 'nullable|numeric',
            'activity_score'    => 'nullable|numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
