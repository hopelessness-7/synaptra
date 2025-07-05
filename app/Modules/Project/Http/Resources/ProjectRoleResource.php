<?php

namespace Modules\Project\Http\Resources;

use App\Modules\Project\Infrastructure\Models\ProjectRole;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin ProjectRole */
class ProjectRoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
        ];
    }
}
