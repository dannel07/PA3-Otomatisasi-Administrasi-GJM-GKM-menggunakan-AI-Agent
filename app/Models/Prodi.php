<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodi';

    protected $fillable = [
        'nama_prodi',
        'kode_prodi',
        'kepala_prodi_id',
        'deskripsi_prodi',
        'jenjang_prodi',
    ];

    public function dosenKepala()
    {
        return $this->belongsTo(Dosen::class, 'kepala_prodi_id');
    }

    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }

    public function matakuliah()
    {
        return $this->hasMany(Matakuliah::class);
    }

    public function laporanGKM()
    {
        return $this->hasMany(LaporanGKM::class);
    }

    public function pencapaianKPI()
    {
        return $this->hasMany(PencapaianKPI::class);
    }
}
