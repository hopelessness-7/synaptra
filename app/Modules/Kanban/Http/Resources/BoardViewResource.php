<?php

namespace Modules\Kanban\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Kanban\Infrastructure\Models\Board;
use Modules\Kanban\Infrastructure\Models\Column;
use Modules\Kanban\Infrastructure\Models\Task;

/** @mixin Board */
class BoardViewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,

            'columns' =>  ColumnResource::collection($this->whenLoaded('columns')),
        ];
    }
}
