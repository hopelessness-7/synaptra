<?php

namespace App\Modules\Kanban\Domain\Enums;

enum RelationTypeEnum: string
{
    case BlockedBy = 'blocked_by';
    case Parent = 'parent';
    case Child = 'child';
    case Related = 'related';

    public function label(): string
    {
        return match ($this) {
            self::BlockedBy => 'Blocked by',
            self::Parent => 'Parent',
            self::Child => 'Child',
            self::Related => 'Related',
        };
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
