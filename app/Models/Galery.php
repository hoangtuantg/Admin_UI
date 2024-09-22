<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'thumbnail'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
