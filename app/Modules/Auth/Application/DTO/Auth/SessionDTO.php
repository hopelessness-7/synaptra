<?php

namespace App\Modules\Auth\Application\DTO\Auth;

use App\DTO\BaseDTO;

class SessionDTO extends BaseDTO
{
    public  string $id;
    public string $ipAddress;
    public int $user_id;
    public string $ip_address;
    public string $user_agent;
    public string $payload;
    public string $last_activity;
}
