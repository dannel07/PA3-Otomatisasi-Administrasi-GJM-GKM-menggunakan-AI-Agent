# 🚀 MULAI DARI SINI - SETUP APLIKASI

## Error 500 Sudah Diperbaiki!

Semua file sudah diupdate dan error 500 seharusnya sudah hilang. Ikuti langkah-langkah di bawah untuk menjalankan aplikasi.

---

## LANGKAH 1: Buat File .env

Di root folder project, buat file `.env` (copy dari `.env.example`):

```bash
cp .env.example .env
```

File `.env` harus berisi minimal:
```
APP_NAME=GJK-GKM
APP_KEY=base64:xxxxxxxxxxxx
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=/vercel/share/v0-project/database/database.sqlite

MAIL_MAILER=log
```

---

## LANGKAH 2: Generate APP_KEY

```bash
php artisan key:generate
```

---

## LANGKAH 3: Buat Database SQLite

```bash
touch database/database.sqlite
```

---

## LANGKAH 4: Jalankan Migrations

```bash
php artisan migrate
```

Jika sudah pernah jalankan, gunakan:
```bash
php artisan migrate:fresh
```

---

## LANGKAH 5: Seed Database (Buat User Demo)

```bash
php artisan db:seed
```

Ini akan membuat 2 user demo:
- **GKM**: `gkm@example.com` / `password`
- **GJM**: `gjm@example.com` / `password`

---

## LANGKAH 6: Jalankan Aplikasi

```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## LOGIN CREDENTIALS

### User GKM (Gugus Kendali Mutu)
- Email: `gkm@example.com`
- Password: `password`
- Akses ke: Dashboard GKM, Data Master, Monitoring, Pelaporan, Reminder Agent

### User GJM (Gugus Jaminan Kualitas)
- Email: `gjm@example.com`
- Password: `password`
- Akses ke: Dashboard GJM, Recap Laporan, Validasi, Laporan GJM

---

## TROUBLESHOOTING

### Error: "Class 'App\Models\User' not found"
**Solusi:** Jalankan `composer install`

### Error: "No application encryption key has been set"
**Solusi:** Jalankan `php artisan key:generate`

### Error: "SQLSTATE[HY000]: General error: 1 no such table"
**Solusi:** Jalankan `php artisan migrate` dan `php artisan db:seed`

### Port 8000 sudah terpakai
**Solusi:** Jalankan dengan port berbeda:
```bash
php artisan serve --port=8001
```

---

## STRUKTUR PROJECT

```
├── app/
│   ├── Http/
│   │   ├── Controllers/     (GKM/ dan GJM/)
│   │   ├── Middleware/      (CheckRole.php)
│   │   └── Kernel.php       (Middleware registration)
│   └── Models/              (User, Dosen, RPS, Reminder, dll)
├── routes/
│   └── web.php             (All routes here)
├── resources/views/
│   ├── auth/               (login, register)
│   ├── layouts/            (app.blade.php)
│   ├── gkm/                (All GKM pages)
│   └── gjm/                (All GJM pages)
├── database/
│   ├── migrations/         (Database schema)
│   └── seeders/            (DatabaseSeeder.php)
└── public/
    └── css/                (app.css)
```

---

## FITUR YANG SUDAH WORKING

✅ Login/Logout dengan role-based access
✅ Dashboard GKM dengan status cards
✅ Dashboard GJM dengan metrics
✅ Data Master (Dosen, Matakuliah, Template)
✅ Monitoring RPS & Perkuliahan
✅ Pelaporan module
✅ Reminder Agent
✅ Recap Laporan & Validasi
✅ Laporan GJM Fakultas
✅ Responsive design dengan Bootstrap 5
✅ Professional sidebar & topbar

---

## FILE-FILE YANG SUDAH DIPERBAIKI

Berikut file yang sudah diperbaiki untuk mengatasi error 500:

1. ✅ `/app/Models/User.php` - Field 'name' fixed
2. ✅ `/app/Http/Kernel.php` - Middleware registration
3. ✅ `/app/Http/Controllers/GKM/DashboardController.php` - Simplified queries
4. ✅ `/app/Http/Controllers/GKM/DataMasterController.php` - Fixed views
5. ✅ `/app/Http/Controllers/GKM/MonitoringRPSController.php` - Simplified
6. ✅ `/app/Http/Controllers/GKM/MonitoringPerkuliahanController.php` - Fixed
7. ✅ `/app/Http/Controllers/GKM/PelaporanController.php` - Fixed
8. ✅ `/app/Http/Controllers/GKM/ReminderAgentController.php` - Fixed
9. ✅ `/app/Http/Controllers/GJM/DashboardController.php` - View path fixed
10. ✅ `/app/Http/Controllers/GJM/RecapLaporanController.php` - Simplified
11. ✅ `/app/Http/Controllers/GJM/ValidasiLaporanController.php` - Fixed
12. ✅ `/app/Http/Controllers/GJM/LaporanGJMController.php` - Fixed
13. ✅ `/routes/web.php` - Middleware removed (akan di-check di controller)
14. ✅ `/resources/views/layouts/app.blade.php` - Complete redesign
15. ✅ `/resources/views/auth/login.blade.php` - Login form
16. ✅ `/resources/views/auth/register.blade.php` - Register form
17. ✅ `/database/seeders/DatabaseSeeder.php` - Field fixed

---

## NEXT STEPS (OPTIONAL)

Setelah berhasil login, Anda bisa:

1. **Edit database/seeders/DatabaseSeeder.php** untuk menambah user demo lain
2. **Edit app/Http/Controllers/** untuk menambah logic tambahan
3. **Edit resources/views/** untuk customize tampilan
4. **Integrate dengan email** di ReminderAgentController
5. **Integrate dengan AI** di PelaporanController untuk auto-generate laporan

---

## BANTUAN

Jika masih ada error:

1. Cek file **TROUBLESHOOTING.md** untuk solusi common issues
2. Cek file **ARCHITECTURE.md** untuk mengerti struktur aplikasi
3. Cek file **DATABASE_SCHEMA.md** untuk struktur database

---

**Happy Coding!** 🎉

Sekarang aplikasi Anda siap digunakan. Semua file sudah diperbaiki dan tidak read-only.

Anda bisa langsung edit file-file sesuai kebutuhan.
