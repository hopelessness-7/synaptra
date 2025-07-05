<?php

namespace App\Modules\Auth\Application\DTO\Auth;

use App\DTO\BaseDTO;

class LoginBlockLogDTO extends BaseDTO
{
    public string $email;
    public string $reason;
    public int $attempts;
    public bool $blocked;
    public string $ip_address;
    public string $user_agent;
}
