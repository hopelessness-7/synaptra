<?php

namespace Modules\AccessControl\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AccessControl\Infrastructure\Models\Role;

/** @mixin Role */
class RoleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,

            'permissions' => PermissionResource::collection($this->permissions),
        ];
    }
}
