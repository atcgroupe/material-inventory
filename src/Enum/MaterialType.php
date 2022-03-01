<?php

namespace App\Enum;

enum MaterialType: int implements AppEnumInterface
{
    case SHEET = 1;
    case ROLL = 2;

    use AppEnumTrait;

    public function getLabel(): string
    {
        return match($this)
        {
            MaterialType::SHEET => 'Feuille/Plaque',
            MaterialType::ROLL => 'Rouleau',
        };
    }
}
