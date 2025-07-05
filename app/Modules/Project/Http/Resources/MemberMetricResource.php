<?php

namespace Modules\Project\Http\Resources;

use App\Modules\Project\Infrastructure\Models\MemberMetric;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin MemberMetric */
class MemberMetricResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'tasks_completed' => $this->tasks_completed,
            'avg_task_time'   => $this->avg_task_time,
            'total_work_time' => $this->total_work_time,
            'quality_score'   => $this->quality_score,
            'activity_score'  => $this->activity_score,

            'member'          => new ProjectMemberResource($this->whenLoaded('member')),
        ];
    }
}
