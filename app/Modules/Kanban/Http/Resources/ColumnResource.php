<?php

namespace Modules\Kanban\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Kanban\Infrastructure\Models\Column;

/** @mixin Column */
class ColumnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'position' => $this->position,

            'tasks_count' => $this->tasks_count,

            'tasks' => TaskShowResource::collection($this->whenLoaded('tasks'))
        ];
    }
}
