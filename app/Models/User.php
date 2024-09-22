<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'fullname',
        'phone_number',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => Role::class,
    ];

    public function scopeSearch($query, $search)
    {
        if ($search) {
            $query->where('email', 'like', '%' . $search . '%')
                ->orWhere('fullname', 'like', '%' . $search . '%')
                ->orWhere('phone_number', 'like', '%' . $search . '%');
        }

        return $query;
    }

    public function getRoleTextAttribute()
    {
        $role = Role::from($this->attributes['role']);

        return match ($role) {
            Role::SuperAdmin => '<span class="badge bg-primary bg-opacity-20 text-success">Super Admin</span>',
            Role::Admin => '<span class="badge bg-primary bg-opacity-20 text-primary">Admin</span>',
        };
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
