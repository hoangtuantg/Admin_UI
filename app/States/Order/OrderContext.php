<?php

declare(strict_types=1);

namespace App\States\Order;

use App\Enums\OrderStatus;

class OrderContext
{
    private OrderState $state;

    public function __construct()
    {
        $this->state = new OrderPendingState();
    }

    public static function makeByOrderStatus(OrderStatus $orderStatus): self
    {
        $instance = new self();
        $instance->setState(app()->make($orderStatus->getClassOrderState()));
        return $instance;
    }

    public function setState(OrderState $state): void
    {
        $this->state = $state;
    }

    public function toApproved(): void
    {
        $this->state->toApproved($this);
    }

    public function toShipping(): void
    {
        $this->state->toShipping($this);
    }

    public function toCompleted(): void
    {
        $this->state->toCompleted($this);
    }

    public function toRefunded(): void
    {
        $this->state->toRefunded($this);
    }

    public function toCanceled(): void
    {
        $this->state->toCanceled($this);
    }

    public function availableTransitions(): array
    {
        return $this->state->availableTransitions();
    }
}
