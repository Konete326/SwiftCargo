<?php

declare(strict_types=1);

namespace app\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Agent = 'agent';
    case User  = 'user';
}
