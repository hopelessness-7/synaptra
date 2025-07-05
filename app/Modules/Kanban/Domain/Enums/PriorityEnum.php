<?php

namespace App\Modules\Kanban\Domain\Enums;

enum PriorityEnum: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Urgent = 'urgent';

    public function label(): string
    {
        return  match ($this) {
            self::Low => 'Low',
            self::Medium => 'Medium',
            self::High => 'High',
            self::Urgent => 'Urgent',
        };
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
