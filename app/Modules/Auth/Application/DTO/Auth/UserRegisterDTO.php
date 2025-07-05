<?php

namespace App\Modules\Auth\Application\DTO\Auth;

use App\DTO\BaseDTO;
use Illuminate\Support\Facades\Hash;

class UserRegisterDTO extends BaseDTO
{
    public string $email;
    public string $password;
    public string $name;
    public string $userAgent;
    public string $ipAddress;


    public function forUserCreation(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];
    }

    public function forDeviceCreation(): array
    {
        return [
            'userAgent' => $this->userAgent,
            'ip' => $this->ipAddress,
        ];
    }
}
