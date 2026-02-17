<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajaran extends Model
{
    use HasFactory;

    protected $table = 'ajaran';

    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'tanggal_mulai',
        'tanggal_akhir',
        'status',
    ];

    public function rps()
    {
        return $this->hasMany(RPS::class);
    }

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class);
    }

    public function laporanGKM()
    {
        return $this->hasMany(LaporanGKM::class);
    }
}
