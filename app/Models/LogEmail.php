<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEmail extends Model
{
    use HasFactory;

    protected $table = 'log_email';

    protected $fillable = [
        'reminder_id',
        'email_tujuan',
        'subjek_email',
        'status_pengiriman',
        'waktu_pengiriman',
        'keterangan',
    ];

    protected $casts = [
        'waktu_pengiriman' => 'datetime',
    ];

    public function reminder()
    {
        return $this->belongsTo(Reminder::class);
    }
}
