# Quick Reference Guide - Sistem GJK dan GKM

## 🚀 Quick Start (5 Menit)

```bash
# 1. Install dependencies
composer install && npm install

# 2. Setup environment
cp .env.example .env && php artisan key:generate

# 3. Database
php artisan migrate && php artisan db:seed

# 4. Build assets
npm run build

# 5. Run server
php artisan serve
```

**Akses**: http://localhost:8000

## 👤 Login Credentials

```
GKM Account:
- Email: gkm@test.com
- Password: password

GJM Account:
- Email: gjm@test.com
- Password: password
```

## 📁 Project Structure Reference

```
Key Directories:
├── app/Models/              ← Database models (16 files)
├── app/Http/Controllers/    ← Controllers (10 files)
├── routes/web.php           ← All routes (105 lines)
├── resources/views/         ← Blade templates (10+ files)
├── database/migrations/     ← Schema (19 files)
└── public/css/app.css       ← Custom styles
```

## 🔌 Key Routes

### GKM Routes
```
/gkm/dashboard
/gkm/data-master
/gkm/monitoring-rps
/gkm/monitoring-perkuliahan
/gkm/pelaporan
/gkm/reminder-agent
```

### GJM Routes
```
/gjm/dashboard
/gjm/recap-laporan
/gjm/validasi-laporan
/gjm/laporan-gjm
```

## 💾 Database Models (Quick Reference)

| Model | Purpose | Key Fields |
|-------|---------|-----------|
| User | Authentication | email, password, role |
| Dosen | Teacher data | nip, nama_dosen, prodi_id |
| Prodi | Study program | nama_prodi, kode_prodi |
| Matakuliah | Course | nama_mk, sks, semester |
| Ajaran | Academic year | tahun_ajaran, semester |
| RPS | Learning plan | file_rps, status_review |
| Materi | Course material | file_materi, status_upload |
| Monitoring | Compliance tracking | persentase_kepatuhan |
| Reminder | Automated reminders | tipe_reminder, status |
| LaporanGKM | GKM reports | kepatuhan_rps, kepatuhan_materi |
| LaporanGJM | GJM reports | periode_laporan, status |
| Kuisioner | Questionnaire | judul_kuisioner, status |

## 🎛️ Common Commands

```bash
# Database
php artisan migrate                 # Run migrations
php artisan migrate:fresh           # Reset database
php artisan db:seed                 # Seed data
php artisan tinker                  # Interactive shell

# Cache
php artisan cache:clear             # Clear all cache
php artisan config:clear            # Clear config cache
php artisan view:clear              # Clear view cache

# Routes
php artisan route:list              # Show all routes
php artisan route:cache             # Cache routes (production)

# Queue (if enabled)
php artisan queue:work              # Start queue worker
php artisan queue:failed             # Show failed jobs

# Testing
php artisan test                    # Run tests
php artisan test --filter=Auth      # Run specific test

# Maintenance
php artisan optimize                # Optimize application
php artisan backup:run              # Create backup
```

## 🔐 Environment Variables

Critical `.env` settings:

```env
# Database
DB_DATABASE=sistem_gjk_gkm
DB_USERNAME=root
DB_PASSWORD=

# Email (for reminders)
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_FROM_ADDRESS=noreply@gjk-gkm.com

# AI (optional)
OPENAI_API_KEY=sk-xxxxx

# Cache
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
```

## 🎯 Controller Quick Reference

### GKM Dashboard Controller
```php
// Location: app/Http/Controllers/GKM/DashboardController.php
// Method: index()
// Shows: status cards, statistics, buttons
// Data: materi_uploaded, rps_lengkap, reminders_pending
```

### Data Master Controller
```php
// Methods:
// - index()          → Show options
// - dosenPengajar()  → List dosen
// - matakuliah()     → List courses
// - templateLaporan()→ Template management
```

### Monitoring RPS Controller
```php
// Methods:
// - index()              → Main page
// - ceklistRPS()         → RPS checklist
// - historyReminder()    → Reminder history
```

## 📊 View Structure

```
resources/views/
├── layouts/
│   ├── app.blade.php         (Main layout)
│   ├── sidebar.blade.php     (Navigation)
│   └── topbar.blade.php      (Header)
├── gkm/
│   ├── dashboard.blade.php
│   ├── data-master/
│   ├── monitoring-rps/
│   ├── monitoring-perkuliahan/
│   ├── pelaporan/
│   └── reminder-agent/
├── gjm/
│   ├── dashboard.blade.php
│   ├── recap-laporan/
│   ├── validasi-laporan/
│   └── laporan-gjm/
└── auth/
    ├── login.blade.php
    └── register.blade.php
```

## 🛡️ Security Checklist

- [x] Password hashing (bcrypt)
- [x] CSRF protection
- [x] SQL injection prevention
- [x] XSS protection
- [x] Role-based access control
- [x] Session-based authentication
- [ ] HTTPS/SSL (setup in production)
- [ ] Rate limiting (implement if needed)
- [ ] 2FA (future enhancement)

## ⚡ Performance Tips

1. **Database**: Use eager loading
   ```php
   // Good
   Dosen::with('prodi', 'matakuiah')->get();
   
   // Avoid (N+1 query)
   $dosenList->prodi;
   ```

2. **Caching**: Cache frequently accessed data
   ```php
   Cache::remember('dosenList', 3600, function() {
       return Dosen::all();
   });
   ```

3. **Pagination**: Always paginate large datasets
   ```php
   $dosen = Dosen::paginate(10);
   ```

4. **Indexes**: Ensure database indexes on searched columns
   - `prodi_id`
   - `dosen_id`
   - `status_*` fields

## 🐛 Debugging

### Enable Debug Mode
```env
APP_DEBUG=true  (development only!)
```

### Use Telescope (development)
```bash
php artisan tinker
# Then in shell:
Telescope::record()
```

### Check Logs
```bash
tail -f storage/logs/laravel.log
```

### Browser Console
- F12 → Console tab
- Check for JavaScript errors

## 📝 Common Customizations

### Change Sidebar Color
Edit `resources/views/layouts/sidebar.blade.php`:
```html
<!-- Line 1: Change bg-primary to another color -->
<aside class="sidebar bg-info text-white">
```

### Add New Route
Edit `routes/web.php`:
```php
Route::middleware('role:GKM')->prefix('gkm')->name('gkm.')->group(function () {
    Route::get('/new-page', [NewController::class, 'index'])->name('newpage');
});
```

### Create New Controller
```bash
php artisan make:controller GKM/NewController
```

### Create New Model
```bash
php artisan make:model NewModel -m  # with migration
```

## 🚨 Troubleshooting Quick Fixes

| Problem | Solution |
|---------|----------|
| Migrations fail | `php artisan migrate:fresh` |
| Assets not loading | `npm run build` |
| Database connection error | Check `.env` DB settings |
| Email not sending | Check `MAIL_*` settings in `.env` |
| 404 on routes | `php artisan route:cache` → clear |
| Session issues | Clear cache: `php artisan cache:clear` |
| Undefined variable | Check controller data passing |

## 📚 Additional Resources

- **Laravel Docs**: https://laravel.com/docs/10.x
- **Blade Templating**: https://laravel.com/docs/10.x/blade
- **Database**: https://laravel.com/docs/10.x/database
- **Bootstrap 5**: https://getbootstrap.com/docs/5.0/
- **Chart.js**: https://www.chartjs.org/docs/latest/

## 📞 Development Tips

### Code Style
```bash
# Check code style (if configured)
./vendor/bin/pint

# Format code
./vendor/bin/pint app/
```

### Pre-commit Checklist
- [ ] No debug statements (dd, dump)
- [ ] No console.log in JS
- [ ] Database migrations created
- [ ] Tests passing
- [ ] Code formatted

### Git Workflow
```bash
git checkout -b feature/feature-name
git add .
git commit -m "Add feature description"
git push origin feature/feature-name
```

## 🎓 Learning Path

1. **Basics** (Start here)
   - [ ] Read Laravel 10 docs intro
   - [ ] Understand MVC pattern
   - [ ] Review this project structure

2. **Models & Database**
   - [ ] Study all 16 models
   - [ ] Understand relationships
   - [ ] Practice Eloquent queries

3. **Controllers & Routes**
   - [ ] Review GKM controllers
   - [ ] Trace request flow
   - [ ] Create test controller

4. **Views & Frontend**
   - [ ] Study Blade syntax
   - [ ] Review Bootstrap classes
   - [ ] Create simple form

5. **Advanced**
   - [ ] Implement services
   - [ ] Setup queue jobs
   - [ ] Add tests

## 📋 Project Checklist

### Setup Phase
- [x] Database schema created
- [x] Models generated
- [x] Controllers implemented
- [x] Routes configured
- [x] Basic views created
- [x] Styling applied
- [x] Documentation written

### Development Phase (TODO)
- [ ] Complete all views
- [ ] Add form validation
- [ ] Implement file upload
- [ ] Setup email sending
- [ ] Add tests
- [ ] Optimize queries
- [ ] Setup caching

### Production Phase (TODO)
- [ ] Configure environment
- [ ] Setup monitoring
- [ ] Configure backups
- [ ] Setup SSL
- [ ] Load testing
- [ ] Security audit
- [ ] Deploy

---

## 🆘 Need Help?

### Resources
1. **Docs**: README.md, SETUP_GUIDE.md, ARCHITECTURE.md
2. **Code**: Check existing implementations
3. **Errors**: Check logs & error messages
4. **Community**: Laravel forums, Stack Overflow

### Contacts
- Email: support@gjk-gkm.com
- Docs: https://docs.gjk-gkm.com

**Happy Coding! 🚀**
