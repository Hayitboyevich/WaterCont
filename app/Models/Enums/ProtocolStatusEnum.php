<?php

namespace App\Models\Enums;

enum ProtocolStatusEnum: int
{
    case NEW = 1;

    case RETURNED = 2;

    case REJECTED = 3;

    case ACCEPTED = 4;
}
