<?php

namespace App\Enum;

enum PiecePrintableFaces: int implements AppEnumInterface
{
    case RECTO = 1;
    case RECTO_VERSO = 2;

    use AppEnumTrait;

    public function getLabel(): string
    {
        return match($this)
        {
            PiecePrintableFaces::RECTO => 'RECTO',
            PiecePrintableFaces::RECTO_VERSO => 'RECTO/VERSO',
        };
    }
}
