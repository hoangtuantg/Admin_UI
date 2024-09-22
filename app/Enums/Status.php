<?php

declare(strict_types=1);

namespace App\Enums;

enum Status: string
{
    case InStock = 'in_stock';
    case OutOfStock = 'out_of_stock';

    public function description(): string
    {
        return match ($this) {
            self::InStock => 'Còn hàng',
            self::OutOfStock => 'Hết hàng',
        };
    }
}
