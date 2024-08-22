<?php

namespace App\Models\Enums;

enum RoleEnum: int
{
    case ADMIN = 1;
    case MANAGER = 2;
    case REGIONAL_INSPECTION = 3;
    case INSPECTOR = 4;
    case OPERATOR = 5;
}
