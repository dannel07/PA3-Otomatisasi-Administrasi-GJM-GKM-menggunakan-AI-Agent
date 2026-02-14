# Database Schema - Sistem GJK dan GKM Fakultas Vokasi

## Penjelasan Database

Sistem ini didesain untuk mengotomatisasi administrasi **GKM (Gugus Kendali Mutu)** dan **GJM (Gugus Jaminan Mutu)** di Fakultas Vokasi dengan fokus pada monitoring dosen.

## Daftar Tabel

### 1. **users**
Tabel untuk autentikasi dan manajemen user sistem
- `id` - ID unik
- `name` - Nama lengkap
- `email` - Email unik
- `username` - Username unik
- `password` - Password terenkripsi
- `nip` - Nomor Induk Pegawai
- `role` - Role user (admin, kaprodi, dosen, gjm_reviewer, gkm_reviewer)
- `email_verified_at` - Timestamp verifikasi email
- `remember_token` - Token remember me

### 2. **prodi**
Tabel data program studi
- `id` - ID unik
- `kode_prodi` - Kode program studi (unique)
- `nama_prodi` - Nama lengkap program studi
- `nama_singkat` - Nama singkat prodi
- `deskripsi` - Deskripsi prodi
- `kaprodi_id` - FK ke dosen (Kepala program studi)

### 3. **dosen**
Tabel data dosen pengajar
- `id` - ID unik
- `user_id` - FK ke users (untuk login)
- `nama_lengkap` - Nama dosen
- `nip` - NIP dosen (unique)
- `gelar_akademik` - Gelar akademik (S.T., M.T., Ph.D., dll)
- `jabatan_akademik` - Jabatan akademik (Asisten Ahli, Lektor, Profesor, dll)
- `kontak_email` - Email dosen
- `nomor_hp` - Nomor HP
- `prodi_id` - FK ke prodi (Program studi dosen)
- `bio` - Biografi dosen
- `foto_profil` - Path foto profil
- `status` - Status dosen (aktif, tidak_aktif, pensiun)

### 4. **ajaran**
Tabel tahun akademik dan semester
- `id` - ID unik
- `tahun_ajaran` - Tahun akademik (2024, 2025, dll)
- `semester` - Semester (ganjil, genap)
- `tanggal_mulai` - Tanggal mulai semester
- `tanggal_akhir` - Tanggal akhir semester
- `status` - Status (aktif, non_aktif)

### 5. **matakuliah**
Tabel data mata kuliah
- `id` - ID unik
- `prodi_id` - FK ke prodi
- `kode_mk` - Kode mata kuliah (unique)
- `nama_mk` - Nama mata kuliah
- `sks` - Jumlah SKS
- `jenis_mk` - Jenis mata kuliah (Teori, Praktik, Seminar, dll)
- `deskripsi` - Deskripsi mata kuliah
- `capaian_pembelajaran` - Learning outcomes
- `status` - Status (aktif, tidak_aktif)

### 6. **rps**
Tabel Rencana Pembelajaran Semester (RPS)
- `id` - ID unik
- `matakuliah_id` - FK ke matakuliah
- `ajaran_id` - FK ke ajaran
- `dosen_id` - FK ke dosen (Dosen pengampu)
- `deskripsi` - Deskripsi RPS
- `capaian_pembelajaran` - Learning outcomes
- `strategi_pembelajaran` - Strategi pembelajaran
- `penugasan` - Detail penugasan
- `penilaian` - Kriteria penilaian
- `file_rps` - File upload RPS
- `status_rps` - Status (draft, menunggu_review, sudah_divalidasi, revisi)
- `tanggal_upload` - Tanggal diunggah
- `tanggal_validasi` - Tanggal divalidasi
- `catatan_validasi` - Catatan dari validator

### 7. **materi**
Tabel materi perkuliahan
- `id` - ID unik
- `rps_id` - FK ke rps
- `judul_materi` - Judul materi
- `deskripsi` - Deskripsi materi
- `pertemuan_ke` - Pertemuan ke berapa
- `file_materi` - File materi (PDF, PPT, doc)
- `file_format` - Format file
- `capaian_pembelajaran` - Learning outcomes materi
- `tanggal_upload` - Tanggal upload
- `status` - Status (belum_upload, sudah_upload, perlu_revisi)
- `catatan` - Catatan tambahan

### 8. **monitoring**
Tabel monitoring kepatuhan dan progress
- `id` - ID unik
- `ajaran_id` - FK ke ajaran
- `prodi_id` - FK ke prodi
- `jenis_monitoring` - Jenis (rps, materi, kuisioner, perwaliaan, evaluasi)
- `total_dosen` - Total dosen yang dipantau
- `dosen_selesai` - Dosen yang selesai
- `dosen_belum` - Dosen yang belum
- `persentase_kepatuhan` - Persentase kepatuhan (%)
- `tanggal_monitoring` - Tanggal monitoring
- `catatan` - Catatan monitoring

### 9. **reminder**
Tabel pengingat otomatis untuk dosen
- `id` - ID unik
- `dosen_id` - FK ke dosen
- `kaprodi_id` - FK ke dosen (Jika untuk kaprodi)
- `tipe_reminder` - Tipe (rps_review, materi_upload, perwaliaan, dll)
- `judul` - Judul reminder
- `deskripsi` - Deskripsi lengkap
- `tanggal_reminder` - Tanggal pengingat
- `waktu_reminder` - Waktu pengingat
- `status` - Status (belum_kirim, sudah_kirim, dibaca, dikerjakan)
- `tanggal_kirim` - Tanggal dikirim
- `metode_pengiriman` - Email, SMS, in-app

### 10. **jadwal_reminder**
Tabel konfigurasi jadwal pengingat
- `id` - ID unik
- `tipe_reminder` - Tipe reminder yang dijadwalkan
- `hari_sebelum_deadline` - Berapa hari sebelum deadline
- `frekuensi` - Frekuensi (sekali, harian, mingguan, bulanan)
- `waktu_pengiriman` - Waktu pengiriman
- `template_pesan` - Template pesan pengingat
- `status` - Status (aktif, tidak_aktif)

### 11. **laporan_gkm**
Tabel laporan GKM (Gugus Kendali Mutu) per prodi
- `id` - ID unik
- `prodi_id` - FK ke prodi
- `ajaran_id` - FK ke ajaran
- `dosen_ketua` - FK ke dosen (Ketua GKM)
- `periode_mulai` - Periode laporan mulai
- `periode_akhir` - Periode laporan akhir
- `jenis_laporan` - Jenis (bulanan, semester, tahunan)
- `ringkasan_temuan` - Ringkasan temuan
- `hasil_monitoring_rps` - Hasil monitoring RPS
- `hasil_monitoring_materi` - Hasil monitoring materi
- `hasil_monitoring_kuisioner` - Hasil monitoring kuisioner
- `rencana_perbaikan` - Rencana perbaikan
- `file_laporan` - File laporan
- `status_laporan` - Status (draft, menunggu_review, approved, revisi)
- `tanggal_submit` - Tanggal submit
- `reviewed_by` - FK ke dosen (Reviewer)
- `tanggal_review` - Tanggal direview
- `catatan_review` - Catatan reviewer

### 12. **laporan_gjm**
Tabel laporan GJM (Gugus Jaminan Mutu) institusi
- `id` - ID unik
- `ajaran_id` - FK ke ajaran
- `periode_mulai` - Periode mulai
- `periode_akhir` - Periode akhir
- `jenis_laporan` - Jenis (bulanan, semester, tahunan)
- `ringkasan_mutu_institusi` - Ringkasan mutu institusi
- `analisis_kepatuhan` - Analisis kepatuhan
- `temuan_utama` - Temuan utama
- `rekomendasi_perbaikan` - Rekomendasi perbaikan
- `rencana_tindakan` - Rencana tindakan
- `file_laporan` - File laporan
- `status_laporan` - Status (draft, menunggu_review, approved, revisi)
- `tanggal_submit` - Tanggal submit
- `reviewed_by` - FK ke users (Reviewer institusi)
- `tanggal_review` - Tanggal direview
- `catatan_review` - Catatan review
- `jumlah_prodi_terlibat` - Jumlah prodi
- `jumlah_laporan_gkm_diterima` - Laporan GKM diterima

### 13. **kuisioner**
Tabel survei/kuesioner
- `id` - ID unik
- `ajaran_id` - FK ke ajaran
- `judul` - Judul kuisioner
- `deskripsi` - Deskripsi
- `target` - Target (dosen, mahasiswa, semua)
- `tanggal_mulai` - Tanggal mulai
- `tanggal_akhir` - Tanggal akhir
- `status` - Status (draft, aktif, tertutup, dianalisis)

### 14. **pertanyaan_kuisioner**
Tabel pertanyaan dalam kuisioner
- `id` - ID unik
- `kuisioner_id` - FK ke kuisioner
- `urutan_pertanyaan` - Urutan pertanyaan
- `pertanyaan` - Teks pertanyaan
- `tipe_pertanyaan` - Tipe (pilihan_ganda, skala_likert, teks_terbuka, checkbox)
- `opsi_jawaban` - Opsi jawaban (JSON format)

### 15. **jawaban_kuisioner**
Tabel jawaban kuisioner dari responden
- `id` - ID unik
- `pertanyaan_kuisioner_id` - FK ke pertanyaan_kuisioner
- `dosen_id` - FK ke dosen (jika responden dosen)
- `responden_identifier` - Identitas responden anonima
- `jawaban` - Jawaban/respon
- `tanggal_jawab` - Tanggal menjawab

### 16. **evaluasi_artefak**
Tabel evaluasi artefak perkuliahan (RPS, materi, soal)
- `id` - ID unik
- `rps_id` - FK ke rps
- `materi_id` - FK ke materi (opsional)
- `evaluator_id` - FK ke dosen (Evaluator)
- `jenis_artefak` - Jenis (rps, materi, soal_ujian)
- `skor_evaluasi` - Skor evaluasi
- `catatan_evaluasi` - Catatan evaluasi
- `status_evaluasi` - Status (approve, revisi, ditolak)
- `tanggal_evaluasi` - Tanggal evaluasi
- `saran_perbaikan` - Saran perbaikan
- `tanggal_revisi_selesai` - Tanggal revisi selesai
- `jumlah_revisi` - Jumlah revisi

### 17. **log_email**
Tabel log pengiriman email
- `id` - ID unik
- `reminder_id` - FK ke reminder
- `penerima_email` - Email penerima
- `subjek` - Subjek email
- `isi_email` - Isi email
- `status_pengiriman` - Status (success, failed, pending)
- `pesan_error` - Pesan error jika gagal
- `tanggal_pengiriman` - Tanggal pengiriman
- `percobaan_kirim` - Jumlah percobaan

### 18. **perwaliaan**
Tabel data perwalian dosen
- `id` - ID unik
- `dosen_id` - FK ke dosen (Dosen wali)
- `ajaran_id` - FK ke ajaran
- `jumlah_mahasiswa` - Jumlah mahasiswa yang diwali
- `tanggal_mulai_perwalian` - Tanggal mulai
- `tanggal_akhir_perwalian` - Tanggal akhir
- `status_perwalian` - Status (belum_dimulai, sedang_berjalan, selesai)
- `jumlah_sesi_konsultasi` - Jumlah sesi
- `catatan_perwalian` - Catatan perwalian
- `nilai_evaluasi` - Nilai evaluasi perwalian

### 19. **pencapaian_kpi**
Tabel monitoring KPI dan pencapaian target
- `id` - ID unik
- `prodi_id` - FK ke prodi
- `ajaran_id` - FK ke ajaran
- `nama_kpi` - Nama KPI
- `deskripsi` - Deskripsi KPI
- `target_nilai` - Target nilai
- `nilai_realisasi` - Nilai realisasi
- `persentase_pencapaian` - Persentase pencapaian
- `status_kpi` - Status (tidak_tercapai, tercapai, terlampaui)
- `catatan_kpi` - Catatan KPI

## Relasi Antar Tabel

```
users (1) -- (N) dosen
users (1) -- (N) laporan_gjm (reviewer)

dosen (1) -- (N) rps
dosen (1) -- (N) evaluasi_artefak
dosen (1) -- (N) laporan_gkm (ketua)
dosen (1) -- (N) reminder
dosen (1) -- (N) perwaliaan
dosen (1) -- (N) jawaban_kuisioner

prodi (1) -- (N) dosen
prodi (1) -- (N) matakuliah
prodi (1) -- (N) laporan_gkm
prodi (1) -- (N) monitoring
prodi (1) -- (N) pencapaian_kpi

ajaran (1) -- (N) rps
ajaran (1) -- (N) monitoring
ajaran (1) -- (N) laporan_gkm
ajaran (1) -- (N) laporan_gjm
ajaran (1) -- (N) kuisioner
ajaran (1) -- (N) perwaliaan
ajaran (1) -- (N) pencapaian_kpi

matakuliah (1) -- (N) rps

rps (1) -- (N) materi
rps (1) -- (N) evaluasi_artefak

kuisioner (1) -- (N) pertanyaan_kuisioner

pertanyaan_kuisioner (1) -- (N) jawaban_kuisioner
```

## Instruksi Setup Laravel

1. **Copy file migrations** ke folder `database/migrations/`

2. **Jalankan migrations:**
```bash
php artisan migrate
```

3. **Buat Models** untuk setiap tabel dengan relationships

4. **Seeder database** dengan data dummy untuk testing

5. **Setup Authentication** menggunakan Laravel Breeze atau Sanctum

## Catatan Penting

- Semua foreign keys menggunakan `onDelete('cascade')` kecuali yang diberi `onDelete('set null')`
- Role user memiliki 5 tipe: admin, kaprodi, dosen, gjm_reviewer, gkm_reviewer
- Status laporan dapat di-track dari draft hingga approved
- Sistem mendukung monitoring kepatuhan dosen dalam 5 aspek utama
- Log email membantu melacak pengiriman reminder otomatis
