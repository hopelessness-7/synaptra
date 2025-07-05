<?php

namespace App\Modules\Project\Domain\Enums;

enum SpecializationEnum: string
{
    case Frontend = 'frontend';
    case Backend = 'backend';
    case Fullstack = 'fullstack';
    case QA = 'qa';
    case DevOps = 'devops';
    case PM = 'pm';

    public function label(): string
    {
        return match ($this) {
            self::Frontend => 'Frontend',
            self::Backend => 'Backend',
            self::Fullstack => 'Fullstack',
            self::QA => 'QA',
            self::DevOps => 'DevOps',
            self::PM => 'PM',
        };
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
