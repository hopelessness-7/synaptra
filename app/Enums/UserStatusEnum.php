<?php

namespace App\Enums;

enum UserStatusEnum: string
{
    case Active = 'active';
    case Blocked =  'blocked';
    case RequiresReauth  = 'requires_reauth';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Активный',
            self::Blocked => 'Заблокирован',
            self::RequiresReauth => 'Переавторизация',
        };
    }
}
