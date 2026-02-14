# Sistem Administrasi GJK dan GKM - Fakultas Vokasi

![Laravel](https://img.shields.io/badge/Laravel-10.0+-red)
![PHP](https://img.shields.io/badge/PHP-8.1+-purple)
![License](https://img.shields.io/badge/License-MIT-green)

Sistem web-based untuk otomatisasi administrasi **GJK (Gugus Jaminan Kualitas)** dan **GKM (Gugus Kendali Mutu)** Fakultas Vokasi dengan fitur monitoring RPS, materi perkuliahan, reminder otomatis, dan pelaporan berbasis AI.

## Fitur Utama

### 🎯 Untuk GKM (Gugus Kendali Mutu)

- **Dashboard GKM**: Overview status upload materi dan RPS per prodi
- **Data Master**: Kelola dosen, mata kuliah, periode akademik, dan template laporan
- **Monitoring RPS & Materi**: Track status kepatuhan upload dengan detail per dosen
- **Monitoring Perkuliahan**: Reminder otomatis untuk perwalian, upload materi, dan review soal
- **Pelaporan**: Generate laporan artefak dan kuisioner (dengan AI assistance)
- **Reminder Agent**: Konfigurasi jadwal pengiriman reminder otomatis dan log email

### 📊 Untuk GJM (Gugus Jaminan Kualitas)

- **Dashboard GJM**: Rekap kepatuhan seluruh prodi dengan visualisasi grafik
- **Recap Laporan**: Analisis grafikKepatuhan dan evaluasi per prodi
- **Validasi & Verifikasi**: Approve atau reject laporan GKM dengan catatan
- **Laporan GJM Fakultas**: Archive laporan bulanan dan tahunan dengan generate otomatis

## Screenshots

### Dashboard GKM
![GKM Dashboard](./docs/screenshots/gkm-dashboard.png)

### Monitoring RPS & Materi
![Monitoring RPS](./docs/screenshots/monitoring-rps.png)

### Dashboard GJM
![GJM Dashboard](./docs/screenshots/gjm-dashboard.png)

## Teknologi Stack

### Backend
- **Laravel 10**: PHP web framework
- **MySQL/PostgreSQL**: Relational database
- **Redis**: Caching dan session management
- **Supervisor**: Queue job management
- **OpenAI API**: AI untuk generate laporan (optional)

### Frontend
- **Bootstrap 5**: Responsive UI framework
- **Chart.js**: Data visualization
- **Blade Templates**: Templating engine
- **HTML5/CSS3/JavaScript**: Web standards

### Deployment
- **Nginx/Apache**: Web server
- **Docker**: Containerization (optional)
- **AWS/DigitalOcean**: Cloud hosting

## Requirements

- PHP 8.1 atau lebih tinggi
- Composer
- MySQL 8.0 atau PostgreSQL 12+
- Node.js 16+ (untuk asset compilation)
- Laravel 10.x

## Quick Start

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/sistem-gjk-gkm.git
cd sistem-gjk-gkm
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Konfigurasi database di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_gjk_gkm
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migrations

```bash
php artisan migrate
php artisan db:seed
```

### 5. Build Assets

```bash
npm run build
# atau untuk development:
npm run dev
```

### 6. Start Development Server

```bash
php artisan serve
```

Buka browser di `http://localhost:8000`

### Test Login Credentials

- **GKM Account**
  - Email: `gkm@test.com`
  - Password: `password`

- **GJM Account**
  - Email: `gjm@test.com`
  - Password: `password`

## Project Structure

```
sistem-gjk-gkm/
├── app/
│   ├── Models/              # Database models
│   ├── Http/
│   │   ├── Controllers/     # GKM & GJM controllers
│   │   └── Middleware/      # Auth & role middleware
│   └── Services/            # Business logic
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── resources/views/
│   ├── layouts/             # Shared layouts
│   ├── gkm/                 # GKM views
│   ├── gjm/                 # GJM views
│   └── auth/                # Authentication views
├── routes/
│   └── web.php              # Route definitions
└── public/
    ├── css/
    └── js/
```

Lihat [ARCHITECTURE.md](./ARCHITECTURE.md) untuk dokumentasi teknis lengkap.

## Database Schema

Sistem menggunakan 16 tabel relasional:

- **users**: User account & authentication
- **dosen**: Data dosen dengan relationships
- **prodi**: Program studi
- **matakuliah**: Mata kuliah
- **ajaran**: Tahun akademik
- **rps**: Rencana Pembelajaran Semester
- **materi**: Materi perkuliahan
- **monitoring**: Tracking compliance
- **reminder**: Automated reminders
- **laporan_gkm**: GKM reports
- **laporan_gjm**: GJM reports
- **kuisioner**: Questionnaire data
- **evaluasi_artefak**: Artifact evaluation
- **log_email**: Email delivery logs
- **jadwal_reminder**: Reminder schedules
- **perwaliaan**: Academic advising

Lihat [DATABASE_SCHEMA.md](./DATABASE_SCHEMA.md) untuk detail lengkap.

## Fitur AI Integration

Sistem terintegrasi dengan AI untuk:

1. **Report Generation**: Otomatis menganalisis data monitoring dan kuisioner
2. **Predictive Analytics**: Prediksi compliance trends
3. **Smart Recommendations**: Rekomendasi perbaikan otomatis

**Configuration** di `.env`:
```env
OPENAI_API_KEY=sk-xxxxxxx
OPENAI_MODEL=gpt-4
```

## Email Configuration

Setup pengiriman reminder email di `.env`:

```env
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=465
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=noreply@gjk-gkm.com
```

## Queue Setup

Untuk mengirim email reminder di background:

```bash
# Start queue worker
php artisan queue:work

# Atau dengan daemonization:
php artisan queue:work --daemon
```

## Testing

```bash
# Run all tests
php artisan test

# Run specific test class
php artisan test Tests/Feature/AuthTest

# Run with coverage
php artisan test --coverage
```

## API Documentation

Dokumentasi API tersedia di `/docs/api` (setelah build).

### Key Endpoints

**GKM Routes:**
```
GET     /gkm/dashboard
GET     /gkm/data-master
GET     /gkm/monitoring-rps
GET     /gkm/monitoring-perkuliahan
POST    /gkm/pelaporan/generate
GET     /gkm/reminder-agent
```

**GJM Routes:**
```
GET     /gjm/dashboard
GET     /gjm/recap-laporan
GET     /gjm/validasi-laporan
GET     /gjm/laporan-gjm
```

## Deployment

### Development
```bash
php artisan serve
```

### Production

1. **Setup server** (Ubuntu 22.04)
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y nginx mysql-server php8.1-fpm php8.1-mysql php8.1-mbstring php8.1-xml
```

2. **Clone & setup**
```bash
git clone ... /var/www/sistem-gjk-gkm
cd /var/www/sistem-gjk-gkm
composer install --no-dev
php artisan migrate --force
```

3. **Configure Nginx** (see SETUP_GUIDE.md)

4. **Setup Supervisor** untuk queue worker
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/sistem-gjk-gkm/artisan queue:work
autostart=true
autorestart=true
```

5. **Backup & monitoring**
```bash
php artisan backup:run
```

Lihat [SETUP_GUIDE.md](./SETUP_GUIDE.md) untuk panduan deployment lengkap.

## Environment Variables

```env
# App
APP_NAME="GJK-GKM"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://gjk-gkm.yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=sistem_gjk_gkm
DB_USERNAME=username
DB_PASSWORD=password

# Cache & Session
CACHE_DRIVER=redis
SESSION_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379

# Email
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=

# AI
OPENAI_API_KEY=
OPENAI_MODEL=gpt-4

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=info
```

## Contributing

1. Fork the repository
2. Create feature branch: `git checkout -b feature/amazing-feature`
3. Commit changes: `git commit -m 'Add amazing feature'`
4. Push to branch: `git push origin feature/amazing-feature`
5. Open Pull Request

## Troubleshooting

### Migrasi gagal
```bash
# Reset database
php artisan migrate:fresh

# Rollback dan retry
php artisan migrate:rollback
php artisan migrate
```

### Assets tidak load
```bash
# Rebuild assets
npm run build

# Clear cache
php artisan cache:clear
php artisan config:clear
```

### Email tidak terkirim
```bash
# Test email configuration
php artisan tinker
Mail::raw('test', fn($m) => $m->to('test@test.com'))->send();
```

## FAQ

**Q: Bisakah saya menggunakan database selain MySQL?**
A: Ya, sistem support PostgreSQL dan database lain yang didukung Laravel.

**Q: Bagaimana integrasi dengan AI?**
A: Sistem menggunakan OpenAI API. Setup OPENAI_API_KEY di .env.

**Q: Apakah sistem mendukung SSO?**
A: Belum, tapi dapat diintegrasikan dengan LDAP/Active Directory.

**Q: Berapa user yang dapat ditangani?**
A: Dengan proper scaling, sistem dapat handle ribuan user concurrent.

## Performance Benchmarks

- Dashboard loading: < 200ms
- Report generation: ~2-5 seconds (dengan AI)
- Database query (typical): < 50ms
- Email sending: Async via queue

## Security

- CSRF protection
- SQL injection prevention
- XSS protection
- Password hashing dengan bcrypt
- Role-based access control
- Rate limiting
- Secure headers (CSP, X-Frame-Options, etc)

## Logs & Monitoring

- Application logs: `storage/logs/`
- Database query logs: Enabled in development
- Email delivery logs: Database table `log_email`
- System monitoring: Integrate dengan monitoring tools (Sentry, New Relic, etc)

## License

MIT License - Lihat [LICENSE](LICENSE) file untuk detail.

## Support

- 📧 Email: support@gjk-gkm.com
- 📖 Docs: https://docs.gjk-gkm.com
- 🐛 Issues: https://github.com/yourusername/sistem-gjk-gkm/issues
- 💬 Discussions: https://github.com/yourusername/sistem-gjk-gkm/discussions

## Changelog

### v1.0.0 (Current)
- ✅ GKM Dashboard & Features
- ✅ GJM Dashboard & Features
- ✅ Authentication & Authorization
- ✅ Database Schema (16 tables)
- ✅ Reminder System
- 🚀 AI Integration (pending)

### Roadmap
- [ ] Mobile app (React Native)
- [ ] Advanced analytics & reporting
- [ ] Workflow automation
- [ ] User activity audit trail
- [ ] Multi-language support
- [ ] API documentation (Swagger/OpenAPI)

---

**Dibuat dengan ❤️ untuk Fakultas Vokasi**

*Last Updated: Februari 2026*
