<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'dosen_id',
        'kode_mk',
        'nama_mk',
        'deskripsi_mk',
        'sks',
        'semester',
        'tipe_mk',
        'status_mk',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function rps()
    {
        return $this->hasMany(RPS::class);
    }

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }
}
