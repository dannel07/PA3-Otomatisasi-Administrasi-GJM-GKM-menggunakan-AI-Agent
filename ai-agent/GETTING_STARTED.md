# Getting Started - Sistem GJK & GKM

## 5 Langkah Cepat Menjalankan Aplikasi

### Langkah 1: Install Dependencies
```bash
cd /path/to/project
composer install
```

### Langkah 2: Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### Langkah 3: Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### Langkah 4: Run Server
```bash
php artisan serve
```

### Langkah 5: Login
Buka browser ke **http://localhost:8000** dan login dengan:

**GKM Account:**
- Email: `gkm@example.com`
- Password: `password`

**GJM Account:**
- Email: `gjm@example.com`
- Password: `password`

---

## Yang Sudah Tersedia

Aplikasi ini sudah **LENGKAP** dengan:

### Database
✅ 19 tabel siap pakai
✅ Semua relationships configured
✅ Migrations sudah dibuat

### Authentication
✅ Login/Register pages
✅ Role-based access control
✅ Session management

### GKM Module (Gugus Kendali Mutu)
✅ Dashboard
✅ Data Master
✅ Monitoring RPS & Materi
✅ Monitoring Perkuliahan
✅ Pelaporan
✅ Reminder Agent

### GJM Module (Gugus Jaminan Kualitas)
✅ Dashboard
✅ Recap Laporan
✅ Validasi Laporan
✅ Laporan GJM

### UI & Styling
✅ Responsive design
✅ Bootstrap 5 integration
✅ Professional color scheme
✅ Icons & animations

---

## Folder Structure Overview

```
📁 app/
  📁 Models/ ...................... 16 models
  📁 Http/
    📁 Controllers/ ............... 10 controllers
    📁 Middleware/ ................ role-based access

📁 database/
  📁 migrations/ .................. 19 migrations
  📁 seeders/ ..................... demo data

📁 resources/
  📁 views/
    📁 auth/ ...................... login, register
    📁 gkm/ ....................... 6 modules
    📁 gjm/ ....................... 4 modules
    📁 layouts/ ................... base template

📁 routes/
  web.php ......................... 40+ routes

📁 public/
  css/app.css ..................... styling
```

---

## File Dokumentasi Penting

| File | Kegunaan |
|------|----------|
| **RUN_GUIDE.md** | Panduan setup lengkap |
| **TROUBLESHOOTING.md** | Troubleshooting error 500 |
| **DATABASE_SCHEMA.md** | Detail schema database |
| **ARCHITECTURE.md** | Arsitektur aplikasi |
| **DEPLOYMENT.md** | Panduan deployment |
| **QUICK_REFERENCE.md** | Developer reference |

---

## Menu Structure

### GKM Sidebar
```
🏠 Dashboard
📊 Data Master
   └─ Data Dosen TRPL
   └─ Data Mata Kuliah Ajaran
   └─ Template Laporan Materi
✅ Monitoring RPS
   └─ Ceklist RPS
   └─ History Reminder
📋 Monitoring Perkuliahan
   └─ Reminder Perwalian
   └─ Reminder Upload Materi
   └─ Reminder Review Soal
📄 Pelaporan
   └─ Laporan Artefak
   └─ Laporan Kuisioner
🔔 Reminder Agent
   └─ Pengaturan Jadwal
   └─ Log Email
🚪 Logout
```

### GJM Sidebar
```
🏠 Dashboard
📈 Rekap Laporan
   └─ Grafik Kepatuhan
   └─ Evaluasi
✔️ Validasi Laporan
   └─ Approve Laporan GKM
📋 Laporan GJM
   └─ Arsip Bulanan
   └─ Arsip Tahunan
🚪 Logout
```

---

## Demo Features

### GKM Dashboard
- Status Upload Materi: 12 sudah, 6 belum
- Status RPS: 15 lengkap, 3 belum
- Reminder Terkirim: 2 dari 4
- Quick actions: Generate Laporan, Kirim Reminder

### GJM Dashboard
- Rekap Laporan GKM dengan progress bars
- Temuan Aktif: 2 temuan
- Grafik Hasil Kuisioner
- Quick actions: Generate Laporan, Validasi

---

## Customization Guide

### Change Application Name
Edit `app/config/app.php`:
```php
'name' => 'Your App Name',
```

### Change Database
Edit `.env`:
```env
DB_CONNECTION=mysql  // atau sqlite, pgsql, dsn
DB_HOST=localhost
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=password
```

### Add More Users
```bash
php artisan tinker
# Inside tinker:
App\Models\User::create([
    'name' => 'User Name',
    'email' => 'email@example.com',
    'password' => bcrypt('password'),
    'role' => 'GKM' // atau GJM
]);
```

### Change Colors
Edit `resources/views/layouts/app.blade.php`:
```css
:root {
    --primary-color: #1e3c72;      /* Ubah sini */
    --secondary-color: #2a5298;    /* Ubah sini */
}
```

---

## Testing Setiap Module

### Test GKM
1. Login dengan GKM account
2. Klik menu Dashboard
3. Cek semua submenu berjalan
4. Klik "Generate Laporan" di Data Master

### Test GJM
1. Login dengan GJM account
2. Lihat Dashboard dengan grafik
3. Test Recap Laporan
4. Test Validasi Laporan

---

## Common Commands

```bash
# Development
php artisan serve                    # Run server
php artisan tinker                   # REPL console

# Database
php artisan migrate                  # Run migrations
php artisan migrate:reset            # Reset database
php artisan db:seed                  # Seed data
php artisan make:migration table     # Create migration

# Cache
php artisan cache:clear              # Clear cache
php artisan config:cache             # Cache config
php artisan view:clear               # Clear views

# Optimization
php artisan optimize                 # Optimize app
php artisan route:cache              # Cache routes
php artisan config:cache             # Cache config

# Generation
php artisan make:controller Name     # Create controller
php artisan make:model Name          # Create model
php artisan make:migration table     # Create migration
```

---

## Security Notes

- Passwords di-hash dengan bcrypt
- CSRF protection aktif di semua forms
- SQL injection prevention via Eloquent ORM
- Role-based authorization via middleware
- Input validation di controllers

**Untuk production**, tambahkan:
- HTTPS/SSL certificate
- Rate limiting
- 2FA authentication
- API key authentication

---

## API Endpoints (Ready for Future Use)

Routes sudah strukturnya untuk API:
```
GET    /api/dosen              - List dosen
GET    /api/matakuliah         - List matakuliah
GET    /api/monitoring         - Monitoring data
POST   /api/reminder           - Send reminder
GET    /api/laporan            - Get reports
```

---

## Next Development Steps

1. **Email Integration**
   - Setup SMTP
   - Create email templates

2. **AI Integration**
   - Integrate OpenAI API
   - Auto-generate reports

3. **File Upload**
   - Setup cloud storage
   - File management

4. **Notifications**
   - Real-time notifications
   - Push notifications

5. **Analytics**
   - Dashboard analytics
   - User tracking

---

## Support Resources

### Quick Help
- Error 500? → Check TROUBLESHOOTING.md
- Setup issue? → Check RUN_GUIDE.md
- Database question? → Check DATABASE_SCHEMA.md
- Need reference? → Check QUICK_REFERENCE.md

### External Resources
- [Laravel Docs](https://laravel.com/docs)
- [Bootstrap Docs](https://getbootstrap.com/docs)
- [PHP Manual](https://www.php.net/manual)

---

## Checklist Sebelum Go Live

- [ ] Database migrations jalan
- [ ] Users bisa login
- [ ] GKM menu accessible
- [ ] GJM menu accessible
- [ ] Styling tampil normal
- [ ] No console errors (F12)
- [ ] Responsive di mobile
- [ ] Email sender configured
- [ ] File uploads working
- [ ] Error logging setup

---

## Contact & Support

Jika ada pertanyaan atau issues:

1. Check documentation files
2. Check TROUBLESHOOTING.md
3. Review log file: `storage/logs/laravel.log`
4. Contact development team

---

**Selamat! Anda siap menggunakan Sistem GJK & GKM!** 🚀

Enjoy! ✨
