<?php

namespace App\Modules\Auth\Application\DTO\Auth;

use App\DTO\BaseDTO;

class LoginDTO extends BaseDTO
{
    public string $email;
    public string $password;
    public string $userAgent;
    public string $ip;
}
