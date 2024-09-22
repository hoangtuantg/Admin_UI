<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Component;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Livewire\Component;

class OrderItemAll extends Component
{
    public $search;

    protected $listeners = [
        'confirmCancel' => 'confirmCancel',
        'changeCancel' => 'changeCancel'
    ];
    public function render()
    {
        $orders = Order::query()
            ->search($this->search)
            ->orderBy('id', 'desc')
            ->paginate(10);

        foreach ($orders as $order) {
            $orderDate = Carbon::parse($order->order_date)->toDateString();
            $currentDate = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh')->toDateString();
            if ($currentDate === $orderDate) {
                $order->newOrder = 1;
            } else {
                $order->newOrder = 0;
            }
            $order->order_date = Carbon::parse($order->order_date)->format('d-m-Y H:i:s');
        }

        return view(
            'livewire.admin.component.order-item-all',
            [
                'orders' => $orders
            ]
        );
    }

    public function changeApprove($id): void
    {
        $order = Order::find($id);
        $order->status = OrderStatus::Approved;
        $order->save();
    }

    public function changeCancel($id): void
    {
        $this->dispatch('order-cancel', $id);
    }

    public function confirmCancel($id): void
    {
        $order = Order::find($id);
        $order->status = OrderStatus::Canceled;
        $order->save();
    }

    public function changeShipping($id): void
    {
        $order = Order::find($id);
        $order->status = OrderStatus::Shipping;
        $order->save();
    }

    public function changeComplete($id): void
    {
        $order = Order::find($id);
        $order->status = OrderStatus::Completed;
        foreach ($order->products as $product) {
            $product->quantity = $product->quantity - $product->pivot->quantity;
            $product->save();
        }
        $order->save();
    }

    public function changeReturn($id): void
    {
        $order = Order::find($id);
        $order->status = OrderStatus::Returned;
        $order->save();
    }
}
