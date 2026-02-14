<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Paksa Laravel pakai tabel "dosen"
    protected $table = 'dosen';

    protected $fillable = [
        'user_id',
        'prodi_id',
        'nama_dosen',
        'email_dosen',
        'gelar_akademik',
        'status_dosen',
        'tanggal_bergabung',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function matakuliah()
    {
        return $this->hasMany(Matakuliah::class);
    }

    public function rps()
    {
        return $this->hasMany(RPS::class);
    }

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class);
    }

    public function perwalian()
    {
        return $this->hasMany(Perwaliaan::class, 'dosen_pembimbing_id');
    }

    public function kuisionerResponses()
    {
        return $this->hasMany(JawabanKuisioner::class);
    }

    public function laporanGKM()
    {
        return $this->hasMany(LaporanGKM::class, 'prodi_id', 'prodi_id');
    }

    public function evaluasiArtefak()
    {
        return $this->hasMany(EvaluasiArtefak::class, 'dosen_id');
    }
}
