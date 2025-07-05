<?php

namespace App\Modules\Auth\Application\DTO\Auth;

use App\DTO\BaseDTO;

class DeviceConfirmationDTO extends BaseDTO
{
    public string $ip;
    public string $userAgent;
}
