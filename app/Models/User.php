<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username', // ✅ DITAMBAHKAN
        'email',
        'password',
        'role',
        'is_active',
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
            'is_active' => 'boolean',
        ];
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class, 'user_penerima_id');
    }

    public function isGKM()
    {
        return $this->role === 'GKM';
    }

    public function isGJM()
    {
        return $this->role === 'GJM';
    }

    public function isDosen()
    {
        return $this->role === 'Dosen';
    }
}
