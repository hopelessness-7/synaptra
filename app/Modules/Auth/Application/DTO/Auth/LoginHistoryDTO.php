<?php

namespace App\Modules\Auth\Application\DTO\Auth;

use App\DTO\BaseDTO;

class LoginHistoryDTO extends BaseDTO
{
    public int $user_id;
    public ?string $ip_address;
    public ?string $user_agent;
    public string $logged_in_at;
    public ?string $device_name;
}
