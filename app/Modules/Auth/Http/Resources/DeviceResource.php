<?php

namespace Modules\Auth\Http\Resources;

use App\Modules\Auth\Infrastructure\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin UserDevice */
class DeviceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'device_name'  => $this->device_name,
            'is_confirmed' => $this->is_confirmed,
            'last_used_at' => $this->last_used_at,
        ];
    }
}
