<?php

namespace App\Http\Resource;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Auth\Http\Resources\DeviceResource;

/** @mixin User */
class UserShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'role'  => $this->role?->name,
            'email' => $this->email,


            'projects' =>  $this->projects->map(function ($project) {
                return [
                    'id'   => $project->id,
                    'name' => $project->name,
                    'slug' => $project->slug,
                ];
            }),
        ];
    }
}
