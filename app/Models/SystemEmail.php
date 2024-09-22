<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemEmail extends Model
{
    use HasFactory;

    protected $table = 'system_email';
    protected $fillable = [
        'mail_username',
        'mail_password',
        'mail_from_address',
        'mail_from_name',
    ];

    public function scopeSearch($query, $search): void
    {
        if ($search) {
            $query->where('mail_username', 'like', '%' . $search . '%')
                ->orWhere('mail_from_address', 'like', '%' . $search . '%')
                ->orWhere('mail_from_name', 'like', '%' . $search . '%');
        }
    }
}
