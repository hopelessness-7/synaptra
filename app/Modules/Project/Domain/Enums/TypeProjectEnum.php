<?php

namespace App\Modules\Project\Domain\Enums;

enum TypeProjectEnum: string
{
    case Mono =  'mono';
    case Micro =  'micro';

    public function label(): string
    {
        return match ($this) {
            self::Mono => 'Mono',
            self::Micro => 'Micro',
        };
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
