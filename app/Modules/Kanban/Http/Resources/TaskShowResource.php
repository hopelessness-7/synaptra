<?php

namespace Modules\Kanban\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Kanban\Infrastructure\Models\Task;

/** @mixin Task */
class TaskShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'status'         => $this->status,
            'priority'       => $this->priority,
            'due_date'       => $this->due_date,
            'started_at'     => $this->started_at,
            'finished_at'    => $this->finished_at,
            'estimated_time' => $this->estimated_time,
            'spent_time'     => $this->spent_time
        ];
    }
}
