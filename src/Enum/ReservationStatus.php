<?php

namespace App\Enum;

enum ReservationStatus: int implements AppEnumInterface
{
    case CREATION = 1;
    case SENT = 2;
    case VALIDATED = 3;
    case REJECTED = 4;

    use AppEnumTrait;

    public function getLabel(): string
    {
        return match($this)
        {
            ReservationStatus::CREATION => 'CREATION',
            ReservationStatus::SENT => 'A TRAITER',
            ReservationStatus::VALIDATED => 'VALIDÉE',
            ReservationStatus::REJECTED => 'REJETÉE',
        };
    }
}
