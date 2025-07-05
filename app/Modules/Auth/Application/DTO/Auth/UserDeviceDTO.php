<?php

namespace App\Modules\Auth\Application\DTO\Auth;

use App\DTO\BaseDTO;

class UserDeviceDTO extends BaseDTO
{
    public int $user_id;
    public string $device_hash;
    public string $device_name;
    public bool $is_confirmed;
    public string $last_used_at;
}
