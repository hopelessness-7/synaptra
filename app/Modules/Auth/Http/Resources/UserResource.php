<?php

namespace Modules\Auth\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\AccessControl\Http\Resources\RoleResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'email'       => $this->email,
            'status'      => $this->status,
            'devises'     => DeviceResource::collection($this->devices),
            'role'        => RoleResource::make($this->role),

            'login_history' => $this->getHistoryLogin->map(function ($loginHistory) {
                return [
                    'id'           => $loginHistory->id,
                    'ip'           => $loginHistory->ip_address,
                    'login_it_at'  => $loginHistory->login_it_at,
                    'device_name'  => $loginHistory->device_name,
                ];
            })
        ];
    }
}
