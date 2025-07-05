<?php

namespace Modules\Kanban\Http\Resources;

use App\Http\Resource\UserShowResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Kanban\Infrastructure\Models\TaskComment;

/** @mixin TaskComment */
class TaskCommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'comment' => $this->comment,
            'parent_comment_id' => $this->parent_comment_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'task' => $this->task->id,
            'user' => new UserShowResource($this->whenLoaded('user')),
        ];
    }
}
