<?php

namespace App\Modules\Kanban\Domain\Enums;

enum StatusEnum: string
{
    case Pending = 'pending';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return  match ($this) {
          self::Pending => 'Pending',
          self::Completed => 'Completed',
          self::Cancelled => 'Cancelled',
        };
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
