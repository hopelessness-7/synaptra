<?php

namespace App\Modules\Project\Domain\Enums;

enum GradeEnum: string
{
    case Intern = 'intern';
    case Junior = 'junior';
    case Middle = 'middle';
    case Senior = 'senior';
    case Lead = 'lead';

    public function label(): string
    {
        return match ($this) {
            self::Intern => 'Intern',
            self::Junior => 'Junior',
            self::Middle => 'Middle',
            self::Senior => 'Senior',
            self::Lead => 'Lead',
        };
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
