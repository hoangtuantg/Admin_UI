<?php

declare(strict_types=1);

namespace App\States\Order;

class OrderReturnedState implements OrderState
{
    public function toApproved(OrderContext $context): void
    {

    }

    public function toShipping(OrderContext $context): void
    {
    }

    public function toCompleted(OrderContext $context): void
    {
    }

    public function toRefunded(OrderContext $context): void
    {
    }

    public function toCanceled(OrderContext $context): void
    {
    }

    public function availableTransitions(): array
    {
        return [];
    }
}
