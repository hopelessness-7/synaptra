<?php

namespace Modules\Kanban\Http\Resources;

use App\Http\Resource\UserShowResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Kanban\Infrastructure\Models\Task;

/** @mixin Task */
class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'position' => $this->position,
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
            'estimated_time' => $this->estimated_time,
            'spent_time' => $this->spent_time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'co_assignees_count' => $this->co_assignees_count,
            'comments_count' => $this->comments_count,
            'watchers_count' => $this->watchers_count,
            'logs_count' => $this->logs_count,

            'CoAssignees' => UserShowResource::collection($this->whenLoaded('CoAssignees')),
            'assignee' => new UserShowResource($this->whenLoaded('assignee')),
            'creator' => new UserShowResource($this->whenLoaded('creator')),
            'watchers' => UserShowResource::collection($this->whenLoaded('watchers')),

            'related' =>  TaskShowResource::collection($this->whenLoaded('relatedTasks')),
            'blockedBy' => TaskShowResource::collection($this->whenLoaded('blockedBy')),
            'children' => TaskShowResource::collection($this->whenLoaded('children')),
            'parents' => TaskShowResource::collection($this->whenLoaded('parents'))
        ];
    }
}
