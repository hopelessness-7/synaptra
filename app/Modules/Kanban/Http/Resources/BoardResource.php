<?php

namespace Modules\Kanban\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Kanban\Infrastructure\Models\Board;
use Modules\Project\Http\Resources\ProjectResource;

/** @mixin Board */
class BoardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'is_default' => $this->is_default,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'project' => $this->project->id,
        ];
    }
}
