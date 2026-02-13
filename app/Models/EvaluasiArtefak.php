<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiArtefak extends Model
{
    use HasFactory;

    protected $table = 'evaluasi_artefak';

    protected $fillable = [
        'dosen_id',
        'rps_id',
        'materi_id',
        'hasil_evaluasi_rps',
        'hasil_evaluasi_materi',
        'hasil_evaluasi_soal',
        'skor_akhir',
        'catatan_evaluasi',
        'tanggal_evaluasi',
    ];

    protected $casts = [
        'tanggal_evaluasi' => 'datetime',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function rps()
    {
        return $this->belongsTo(RPS::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
