<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanGJM extends Model
{
    use HasFactory;

    protected $table = 'laporan_gjm';

    protected $fillable = [
        'periode_laporan',
        'file_laporan',
        'ringkasan_kepatuhan',
        'total_prodi',
        'prodi_sesuai_standar',
        'catatan_laporan',
        'status_laporan',
        'tanggal_buat_laporan',
        'dibuat_oleh',
        'tanggal_persetujuan',
        'disetujui_oleh',
    ];

    protected $casts = [
        'tanggal_buat_laporan' => 'datetime',
        'tanggal_persetujuan' => 'datetime',
    ];

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function disetujuiOleh()
    {
        return $this->belongsTo(User::class, 'disetujui_oleh');
    }
}
