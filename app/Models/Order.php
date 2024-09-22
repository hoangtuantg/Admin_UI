<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'phone_number',
        'fullname',
        'email',
        'address',
        'note',
        'total',
        'status',
        'order_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            OrderStatus::Pending => '<span class="badge bg-primary bg-opacity-20 text-primary">Chưa xác nhận</span>',
            OrderStatus::Approved => '<span class="badge bg-primary bg-opacity-20 text-success">Đã xác nhận</span>',
            OrderStatus::Shipping => '<span class="badge bg-info bg-opacity-20 text-warning">Đang giao hàng</span>',
            OrderStatus::Completed => '<span class="badge bg-success bg-opacity-20 text-success">Đã hoàn thành</span>',
            OrderStatus::Canceled => '<span class="badge bg-danger bg-opacity-20 text-danger">Đã hủy</span>',
            OrderStatus::Returned => '<span class="badge bg-danger bg-opacity-20 text-danger">Đã hoàn hàng</span>',
        };
    }

    public function getStatusClientAttribute()
    {
        return match ($this->status) {
            OrderStatus::Pending => '<span class="badge bg-primary bg-opacity-20 px-3 py-2 text-light">Chưa xác nhận</span>',
            OrderStatus::Approved => '<span class="badge bg-primary bg-opacity-20 px-3 py-2 text-light">Đã xác nhận</span>',
            OrderStatus::Shipping => '<span class="badge bg-info bg-opacity-50 px-3 py-2 text-light">Đang giao hàng</span>',
            OrderStatus::Completed => '<span class="badge bg-success bg-opacity-20 px-3 py-2 text-light">Đã hoàn thành</span>',
            OrderStatus::Canceled => '<span class="badge bg-danger bg-opacity-20 px-3 py-2 text-light">Đã hủy</span>',
            OrderStatus::Returned => '<span class="badge bg-danger bg-opacity-20 px-3 py-2 text-light">Đã hoàn hàng</span>',
        };
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot([
            'quantity',
            'price',
            'total',
            'thumbnail',
        ]);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('code', 'like', '%' . $search . '%')
                ->orWhere('phone_number', 'like', '%' . $search . '%')
                ->orWhere('fullname', 'like', '%' . $search . '%')
                ->orWhere('note', 'like', '%' . $search . '%')
                ->orWhere('total', 'like', '%' . $search . '%')
                ->orWhere('order_date', 'like', '%' . $search . '%');
        }

        return $query;
    }
}
