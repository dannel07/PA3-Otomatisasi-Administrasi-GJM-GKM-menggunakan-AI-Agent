<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateLaporan extends Model
{
    protected $fillable = [
        'nama_template',
        'nama_file',
        'jenis_file',
        'file_path',
        'ukuran_file',
        'deskripsi',
        'uploaded_by',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
