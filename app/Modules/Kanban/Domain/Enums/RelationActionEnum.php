<?php

namespace App\Modules\Kanban\Domain\Enums;

enum RelationActionEnum: string
{
    case AddRelated      = 'addRelated';
    case RemoveRelated   = 'removeRelated';
    case AddBlockedBy    = 'addBlockedBy';
    case RemoveBlockedBy = 'removeBlockedBy';
    case AddParents      = 'addParents';
    case RemoveParents   = 'removeParents';
    case AddChildren     = 'addChildren';
    case RemoveChildren  = 'removeChildren';

    public function isAdd(): bool
    {
        return str_starts_with($this->value, 'add');
    }

    public function isRemove(): bool
    {
        return str_starts_with($this->value, 'remove');
    }

    public function relationType(): RelationTypeEnum
    {
        return match ($this) {
            self::AddRelated, self::RemoveRelated       => RelationTypeEnum::Related,
            self::AddBlockedBy, self::RemoveBlockedBy   => RelationTypeEnum::BlockedBy,
            self::AddParents, self::RemoveParents       => RelationTypeEnum::Parent,
            self::AddChildren, self::RemoveChildren     => RelationTypeEnum::Child,
        };
    }

    public static function fromParts(string $action, string $type): self
    {
        $typeMap = [
            'related'     => 'Related',
            'blocked-by'  => 'BlockedBy',
            'parent'      => 'Parents',
            'child'       => 'Children',
        ];

        $normalizedType = $typeMap[$type] ?? throw new \InvalidArgumentException("Unknown relation type: $type");
        $enumValue = $action . $normalizedType;

        return match ($enumValue) {
            self::AddRelated->value      => self::AddRelated,
            self::RemoveRelated->value   => self::RemoveRelated,
            self::AddBlockedBy->value    => self::AddBlockedBy,
            self::RemoveBlockedBy->value => self::RemoveBlockedBy,
            self::AddParents->value      => self::AddParents,
            self::RemoveParents->value   => self::RemoveParents,
            self::AddChildren->value     => self::AddChildren,
            self::RemoveChildren->value  => self::RemoveChildren,
            default => throw new \InvalidArgumentException("Unknown action combination: $enumValue")
        };
    }

    public function methodName(): string
    {
        return $this->value;
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}

