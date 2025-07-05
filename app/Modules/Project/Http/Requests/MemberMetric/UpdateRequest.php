<?php

namespace Modules\Project\Http\Requests\MemberMetric;

use App\Http\Request\BaseFormRequest;

class UpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'member_id'         => 'nullable|integer|exists:members,id',
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
