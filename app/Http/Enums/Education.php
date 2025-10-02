<?php

namespace App\Http\Enums;

enum Education: string
{
    case HighSchool = 'Ensino Médio';
    case Graduate   = 'Graduação';
    case Master     = 'Mestrado';
    case Doctorate  = 'Doutorado';

    public static function options(): array {
        return array_map(
            fn($case) => ['name' => $case->name, 'value' => $case->value],
            self::cases()
        );
    }
}