<?php

namespace Modules\Project\Http\Resources;

use App\Modules\Project\Infrastructure\Models\ProjectMember;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Http\Resources\UserResource;

/** @mixin ProjectMember */
class ProjectMemberResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'grade'          => $this->grade,
            'specialization' =>  $this->specialization,
            'load'           => $this->load,
            'is_available'   => $this->is_available,

            'project'        => new ProjectResource($this->whenLoaded('project')),
            'user'           => new UserResource($this->whenLoaded('user')),
            'role'           => new ProjectRoleResource($this->whenLoaded('role')),
        ];
    }
}
