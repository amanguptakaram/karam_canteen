<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'emp_code',
        'name',
        'email',
        'department',
        'password',
        'role_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userRole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasPermission(string $permission): bool
    {
        // Super admin / legacy admin access
        if ($this->role === 'admin') {
            return true;
        }

        if (!$this->userRole) {
            return false;
        }

        return $this->userRole
            ->permissions()
            ->where('slug', $permission)
            ->exists();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
