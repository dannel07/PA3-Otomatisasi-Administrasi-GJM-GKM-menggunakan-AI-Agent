<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('template_laporans', function (Blueprint $table) {
            // Cek dan tambahkan kolom jika belum ada
            if (!Schema::hasColumn('template_laporans', 'nama_template')) {
                $table->string('nama_template')->after('id');
            }
            if (!Schema::hasColumn('template_laporans', 'nama_file')) {
                $table->string('nama_file')->after('nama_template');
            }
            if (!Schema::hasColumn('template_laporans', 'jenis_file')) {
                $table->string('jenis_file', 10)->after('nama_file');
            }
            if (!Schema::hasColumn('template_laporans', 'file_path')) {
                $table->string('file_path')->after('jenis_file');
            }
            if (!Schema::hasColumn('template_laporans', 'ukuran_file')) {
                $table->integer('ukuran_file')->nullable()->after('file_path');
            }
            if (!Schema::hasColumn('template_laporans', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('ukuran_file');
            }
            if (!Schema::hasColumn('template_laporans', 'uploaded_by')) {
                $table->foreignId('uploaded_by')->nullable()->after('deskripsi')->constrained('users')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('template_laporans', function (Blueprint $table) {
            $table->dropForeign(['uploaded_by']);
            $table->dropColumn([
                'nama_template',
                'nama_file',
                'jenis_file',
                'file_path',
                'ukuran_file',
                'deskripsi',
                'uploaded_by'
            ]);
        });
    }
};
