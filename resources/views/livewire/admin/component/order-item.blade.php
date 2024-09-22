<div class="col">
    <div class="card">
        <div class="card-body">
            <div class="">
                @php
                    use App\Enums\OrderStatus;
                @endphp
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Mã đơn hàng</th>
                        <th class="text-center">Tên khách hàng</th>
                        <th class="text-center">Tổng tiền</th>
                        <th class="text-center">Ngày đặt đơn</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="text-center">{{ $loop->index + 1 + $orders->perPage() * ($orders->currentPage() - 1)  }}</td>
                            @if($order->newOrder)
                                <td class="d-flex justify-content-center">
                                    <a href="{{ route('admin.orders.show',['id'=>$order->id]) }}">#{{ $order->code }}</a>
                                    <sup>
                                        <p class="badge mt-1">Mới</p>
                                    </sup>
                                </td>
                            @else
                                <td><a href="{{ route('admin.orders.show',['id'=>$order->id]) }}">#{{ $order->code }}</a></td>
                            @endif
                            <td><a href="{{ route('admin.orders.show',['id'=>$order->id]) }}">#{{ $order->code }}</a></td>
                            <td>{{ $order->fullname}}</td>
                            <td><b>{{ number_format($order->total, 0, ',', '.') }} VNĐ</b></td>
                            <td>{{ $order->order_date }}</td>
                            <td class="text-center">{!! $order->statusText !!}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <a href="#" class="text-body" data-bs-toggle="dropdown">
                                        <i class="ph-list"></i>
                                    </a>
                                    <ul class="form-control dropdown-menu dropdown-menu-end">
                                        @if($order->status == OrderStatus::Pending)
                                            <li>
                                                <a wire:click="handleChangeApprove({{ $order->id }})" class="dropdown-item">
                                                    <i class="ph-paper-plane-tilt me-2"></i>
                                                    Xác nhận
                                                </a>
                                            </li>
                                            <li class="dropdown-divider"></li>
                                        @endif
                                        <li>
                                            <a wire:click="handleChangeCancel({{ $order->id }})" class="dropdown-item text-danger">
                                                <i class="ph-file-x me-2"></i>
                                                Hủy đơn
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="dropdown-item">
                                                <i class="ph-eye me-2"></i>
                                                Xem chi tiết
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end align-items-center w-100 mt-3">
                    <div class="pagination">
                        {{ $orders->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('style_custom')
    <style>
        .badge {
            background-color: #ff0000;
            color: #fff;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 0.75rem;
            transform: translateY(-30%); /* Fine-tune vertical positioning */
        }
    </style>
@endsection
