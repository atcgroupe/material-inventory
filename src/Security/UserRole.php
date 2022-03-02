<?php

namespace App\Security;

enum UserRole: string
{
    case ADMIN = 'ROLE_ADMIN';
    case STORE_KEEPER = 'ROLE_STORE_KEEPER';
    case GRAPHIC_DESIGNER = 'ROLE_GRAPHIC_DESIGNER';
    case MATERIAL_MANAGER = 'ROLE_MATERIAL_MANAGER';
}
