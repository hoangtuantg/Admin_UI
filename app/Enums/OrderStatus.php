<?php

declare(strict_types=1);

namespace App\Enums;

use App\States\Order\OrderApprovedState;
use App\States\Order\OrderCanceledState;
use App\States\Order\OrderCompletedState;
use App\States\Order\OrderPendingState;
use App\States\Order\OrderReturnedState;
use App\States\Order\OrderShippingState;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Shipping = 'shipping';
    case Completed = 'completed';
    case Canceled = 'canceled';

    case Returned = 'returned';

    public function description(): string
    {
        return match ($this) {
            self::Pending => 'Chưa xác nhận',
            self::Approved => 'Đã xác nhận',
            self::Shipping => 'Đang giao hàng',
            self::Completed => 'Đã hoàn thành',
            self::Canceled => 'Đã hủy',
            self::Returned => 'Đã hoàn hàng',
        };
    }

    public function getClassOrderState(): string
    {
        return match ($this) {
            self::Pending => OrderPendingState::class,
            self::Approved => OrderApprovedState::class,
            self::Shipping => OrderShippingState::class,
            self::Completed => OrderCompletedState::class,
            self::Returned => OrderReturnedState::class,
            self::Canceled => OrderCanceledState::class,
        };
    }
}
