<?php

namespace App\Enums;

enum CountryEnum: int
{
    case USA = 0;
    case COLOMBIA = 1;
    case UKRAINE = 2;

    public static function getNames(): array
    {
        return [
            self::USA->value => 'United States',
            self::COLOMBIA->value => 'Colombia',
            self::UKRAINE->value => 'Ukraine',
        ];
    }

    public function getName(): string
    {
        return self::getNames()[$this->value] ?? 'Unknown';
    }
}
