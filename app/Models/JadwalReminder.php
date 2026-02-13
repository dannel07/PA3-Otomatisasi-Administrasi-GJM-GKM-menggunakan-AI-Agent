<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalReminder extends Model
{
    use HasFactory;

    protected $table = 'jadwal_reminder';

    protected $fillable = [
        'nama_jadwal',
        'tipe_reminder',
        'hari_pengiriman',
        'jam_pengiriman',
        'pesan_template',
        'is_active',
        'dibuat_oleh',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
