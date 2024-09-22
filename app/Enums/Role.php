<?php

declare(strict_types=1);

namespace App\Enums;

enum Role: string
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';

    public function description(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Quản trị viên cấp cao',
            self::Admin => 'Quản trị viên',
        };
    }
}
