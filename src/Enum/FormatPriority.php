<?php

namespace App\Enum;

enum FormatPriority: int implements AppEnumInterface
{
    case HIGH = 1;
    case STANDARD = 2;
    case EXCEPTION = 3;

    use AppEnumTrait;

    public function getLabel(): string
    {
        return match($this)
        {
            FormatPriority::HIGH => 'A Privilégier',
            FormatPriority::STANDARD => 'Usage standard',
            FormatPriority::EXCEPTION => 'Usage exceptionnel',
        };
    }
}
