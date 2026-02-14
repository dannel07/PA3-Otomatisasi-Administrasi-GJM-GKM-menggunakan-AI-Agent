# Panduan Menjalankan Aplikasi Sistem GJK & GKM

## Prasyarat
- PHP 8.2+
- Composer
- Laravel 12
- SQLite atau database lainnya

## Langkah-langkah Setup

### 1. Install Dependencies
```bash
composer install
```

### 2. Buat File .env
```bash
cp .env.example .env
```

### 3. Generate Application Key
```bash
php artisan key:generate
```

### 4. Database Migration
```bash
php artisan migrate
```

### 5. Seeder Data (Untuk Demo)
```bash
php artisan db:seed
```

### 6. Jalankan Server
```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

## Demo Accounts

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

### GKM (Gugus Kendali Mutu)
- **Email**: gkm@example.com
- **Password**: password

### GJM (Gugus Jaminan Kualitas)
- **Email**: gjm@example.com
- **Password**: password

## Struktur Folder

```
project/
├── app/
│   ├── Models/              # Data models (User, Dosen, RPS, dll)
│   ├── Http/
│   │   ├── Controllers/     # Controller untuk GKM dan GJM
│   │   └── Middleware/      # Middleware untuk role-based access
├── database/
│   ├── migrations/          # Database migrations (19 tables)
│   └── seeders/             # Database seeders
├── resources/
│   └── views/
│       ├── auth/            # Login & Register pages
│       ├── gkm/             # GKM module views
│       ├── gjm/             # GJM module views
│       └── layouts/         # Layout templates
├── routes/
│   └── web.php              # Route definitions
└── public/
    └── css/
        └── app.css          # Custom styling
```

## Fitur Utama

### GKM Dashboard
- Dashboard dengan status upload materi dan RPS
- Data Master (Dosen, Mata Kuliah, Template)
- Monitoring RPS & Materi
- Monitoring Perkuliahan
- Pelaporan Otomatis (AI-ready)
- Reminder Agent dengan pengaturan jadwal

### GJM Dashboard
- Recap Laporan KGM dengan grafik
- Validasi & Verifikasi Laporan
- Laporan GJM Fakultas
- Arsip Laporan Bulanan & Tahunan

## Role-Based Access

Sistem menggunakan middleware untuk mengontrol akses berdasarkan role:

- **GKM (Gugus Kendali Mutu)**: Akses ke semua menu GKM
- **GJM (Gugus Jaminan Kualitas)**: Akses ke semua menu GJM

Setiap user hanya bisa mengakses menu sesuai dengan rolenya.

## Database Schema

Database terdiri dari 19 tabel:

1. **users** - Autentikasi dan user management
2. **prodi** - Program studi
3. **dosen** - Data dosen
4. **matakuliah** - Mata kuliah
5. **ajaran** - Tahun akademik
6. **rps** - Rencana Pembelajaran Semester
7. **materi** - Materi perkuliahan
8. **monitoring** - Monitoring kepatuhan
9. **reminder** - Pengingat otomatis
10. **laporan_gkm** - Laporan GKM
11. **laporan_gjm** - Laporan GJM
12. **kuisioner** - Survey/evaluasi
13. **pertanyaan_kuisioner** - Pertanyaan kuisioner
14. **jawaban_kuisioner** - Jawaban kuisioner
15. **evaluasi_artefak** - Evaluasi RPS dan materi
16. **log_email** - Log pengiriman email
17. **jadwal_reminder** - Jadwal reminder
18. **perwaliaan** - Data perwalian
19. **pencapaian_kpi** - KPI pencapaian

## Troubleshooting

### Error 500
Jika mendapatkan error 500:
1. Pastikan `.env` file sudah benar
2. Jalankan `php artisan migrate` jika belum
3. Periksa file log di `storage/logs/`

### Database tidak tersambung
1. Pastikan database sudah dibuat
2. Periksa konfigurasi `.env` file
3. Jalankan `php artisan migrate`

### Cache issue
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Dokumentasi Lengkap

Untuk dokumentasi lebih lengkap, lihat file:
- `DATABASE_SCHEMA.md` - Schema database detail
- `ARCHITECTURE.md` - Arsitektur aplikasi
- `IMPLEMENTATION_SUMMARY.md` - Ringkasan implementasi

## Support

Jika ada pertanyaan atau issue, silakan buat issue di repository atau hubungi tim development.
