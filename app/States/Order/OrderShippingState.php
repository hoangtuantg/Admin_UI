<?php

declare(strict_types=1);

namespace App\States\Order;

use App\Enums\OrderStatus;

class OrderShippingState implements OrderState
{
    public function toApproved(OrderContext $context): void
    {

    }

    public function toShipping(OrderContext $context): void
    {
        // it here
    }

    public function toCompleted(OrderContext $context): void
    {
        $context->setState(new OrderCompletedState());
    }

    public function toRefunded(OrderContext $context): void
    {
        $context->setState(new OrderRefundedState());
    }

    public function toCanceled(OrderContext $context): void
    {
        $context->setState(new OrderCanceledState());
    }


    public function availableTransitions(): array
    {
        return [OrderStatus::Completed, OrderStatus::Refunded, OrderStatus::Canceled];
    }
}
