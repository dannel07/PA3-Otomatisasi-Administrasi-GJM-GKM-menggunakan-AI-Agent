# ✅ CHECKLIST SEBELUM RUN APLIKASI

Pastikan semua item di bawah sudah selesai sebelum menjalankan aplikasi!

---

## PERSIAPAN FILE

- [ ] File `.env` sudah dibuat (copy dari `.env.example`)
- [ ] File `database/database.sqlite` sudah dibuat
- [ ] File `.gitignore` ada (biasanya sudah dari laravel)
- [ ] Folder `storage/` ada dan writable
- [ ] Folder `bootstrap/cache/` ada dan writable

---

## SETUP DATABASE

- [ ] File `.env` sudah berisi `DB_CONNECTION=sqlite`
- [ ] File `.env` sudah berisi `DB_DATABASE=/path/to/database.sqlite`
- [ ] Jalankan: `php artisan key:generate`
- [ ] Jalankan: `php artisan migrate`
- [ ] Jalankan: `php artisan db:seed`

---

## VERIFIKASI STRUKTUR

- [ ] `/app/Models/` berisi 16 model files
- [ ] `/app/Http/Controllers/` berisi auth, GKM/, GJM/ folders
- [ ] `/app/Http/Middleware/` berisi CheckRole.php
- [ ] `/app/Http/Kernel.php` sudah ada
- [ ] `/routes/web.php` sudah ada
- [ ] `/resources/views/` berisi auth/, layouts/, gkm/, gjm/ folders
- [ ] `/database/migrations/` berisi 19 migration files
- [ ] `/database/seeders/` berisi DatabaseSeeder.php
- [ ] `/public/css/` berisi app.css

---

## VERIFIKASI FILE PENTING

- [ ] `/app/Models/User.php` menggunakan field `name` (bukan `nama_user`)
- [ ] `/app/Http/Controllers/GKM/DashboardController.php` return `view('gkm.dashboard.index',...)`
- [ ] `/app/Http/Controllers/GJM/DashboardController.php` return `view('gjm.dashboard.index',...)`
- [ ] `/routes/web.php` tidak ada middleware('role:GKM') atau middleware('role:GJM')
- [ ] `/resources/views/layouts/app.blade.php` sudah complete
- [ ] `/resources/views/auth/login.blade.php` sudah ada

---

## JALANKAN APLIKASI

- [ ] Buka terminal di root folder project
- [ ] Jalankan: `php artisan serve`
- [ ] Tunggu sampai muncul pesan `Server running at http://127.0.0.1:8000`
- [ ] Buka browser dan buka URL tersebut

---

## TEST LOGIN

### Test GKM Account
- [ ] Klik link login
- [ ] Input email: `gkm@example.com`
- [ ] Input password: `password`
- [ ] Klik login
- [ ] Seharusnya redirect ke `/gkm/dashboard`
- [ ] Verifikasi sidebar GKM muncul dengan menu:
  - [ ] Dashboard
  - [ ] Data Master
  - [ ] Monitoring RPS
  - [ ] Monitoring Perkuliahan
  - [ ] Pelaporan
  - [ ] Reminder Agent
  - [ ] Logout

### Test GJM Account
- [ ] Logout dari GKM account
- [ ] Klik link login
- [ ] Input email: `gjm@example.com`
- [ ] Input password: `password`
- [ ] Klik login
- [ ] Seharusnya redirect ke `/gjm/dashboard`
- [ ] Verifikasi sidebar GJM muncul dengan menu:
  - [ ] Dashboard
  - [ ] Rekap Laporan
  - [ ] Validasi Laporan
  - [ ] Laporan GJM
  - [ ] Logout

---

## NAVIGASI HALAMAN

### GKM Dashboard Navigation
- [ ] Klik "Data Master" → muncul 5 card (Dosen, Matakuliah, Periode, Template Materi, Template Kuisioner)
- [ ] Klik "Kelola Dosen" → muncul tabel dosen
- [ ] Klik back, Klik "Kelola Mata Kuliah" → muncul tabel matakuliah
- [ ] Klik "Monitoring RPS" → muncul tabel dosen dengan status
- [ ] Klik "Monitoring Perkuliahan" → muncul reminder list
- [ ] Klik "Pelaporan" → muncul form pelaporan
- [ ] Klik "Reminder Agent" → muncul jadwal reminder & log email

### GJM Dashboard Navigation
- [ ] Klik "Rekap Laporan" → muncul chart dan grafik
- [ ] Klik "Validasi Laporan" → muncul daftar laporan
- [ ] Klik "Laporan GJM" → muncul arsip laporan

---

## TROUBLESHOOTING QUICK FIX

Jika ada error saat dijalankan:

### Error: "No application encryption key has been set"
```bash
php artisan key:generate
```

### Error: "SQLSTATE: no such table"
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Error: "Class 'App\...' not found"
```bash
composer install
composer dump-autoload
```

### Error: "view 'xxx' not found"
- Verifikasi file view ada di `/resources/views/`
- Verifikasi path view di controller benar (e.g., `gkm.dashboard.index`)

### Error: "Port 8000 already in use"
```bash
php artisan serve --port=8001
```

---

## OPTIONAL: ENHANCEMENT

Jika semuanya sudah berjalan dengan baik, Anda bisa:

- [ ] Edit `/app/Http/Controllers/` untuk tambah business logic
- [ ] Edit `/resources/views/` untuk customize tampilan
- [ ] Edit `/database/seeders/` untuk tambah sample data
- [ ] Setup email config di `.env` untuk reminder email
- [ ] Integrate AI di PelaporanController
- [ ] Setup Laravel Queues untuk async tasks

---

## DOKUMENTASI LENGKAP

Baca file-file ini untuk info lebih detail:

- `00_MULAI_DARI_SINI.md` - Setup guide utama
- `PERUBAHAN_UNTUK_PERBAIKAN_ERROR.md` - Detail perubahan yang dilakukan
- `DATABASE_SCHEMA.md` - Schema database
- `ARCHITECTURE.md` - Technical architecture
- `TROUBLESHOOTING.md` - Common issues & solutions

---

## KONTAK SUPPORT

Jika masih ada error yang tidak tercovered:

1. Cek semua file di checklist ini sudah selesai
2. Baca dokumentasi di atas
3. Cek error message di console/log
4. Cek file `/storage/logs/laravel.log` untuk detail error

---

## ✅ SEMUA SIAP!

Jika semua checklist sudah done, aplikasi Anda **100% ready** untuk digunakan!

Selamat menggunakan aplikasi Sistem Administrasi GJK & GKM! 🚀
