<?php

namespace App\Modules\Auth\Application\DTO;

use App\DTO\BaseDTO;
use App\Enums\UserStatusEnum;

class UserDTO extends BaseDTO
{
    public ?string $name;
    public ?string $email;
    public ?string $password;
    public ?int $roleId;
    public ?UserStatusEnum $status;

}
