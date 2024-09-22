<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Component;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Livewire\Component;

class OrderItem extends Component
{
    protected $listeners = [
        'refresh' => '$refresh',
        'confirmCancel' => 'handleConfirmCancel',
    ];

    public function render()
    {
        $orders = Order::query()->where('status', 'pending')
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

        return view('livewire.admin.component.order-item', [
            'orders' => $orders
        ]);
    }

    public function handleChangeApprove($id): void
    {
        $order = Order::find($id);
        $order->status = OrderStatus::Approved;
        $order->save();
    }

    public function handleChangeCancel($id): void
    {
        $this->dispatch('order-cancel', $id);
    }

    public function handleConfirmCancel($id): void
    {
        $order = Order::find($id);
        $order->status = OrderStatus::Canceled;
        $order->save();
    }
}
