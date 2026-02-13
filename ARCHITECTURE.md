# Arsitektur Sistem Administrasi GJK dan GKM

## 1. Gambaran Umum

Sistem ini dibangun menggunakan **Laravel 10** dengan arsitektur **MVC (Model-View-Controller)** yang scalable dan maintainable. Sistem dirancang untuk mendukung otomatisasi proses administrasi GJK/GKM dengan fitur monitoring real-time, reminder otomatis, dan pelaporan berbasis AI.

## 2. Diagram Arsitektur

```
┌─────────────────────────────────────────────────────────────┐
│                     Aplikasi Web (Browser)                  │
└──────────────────────────────┬──────────────────────────────┘
                                │
┌──────────────────────────────┴──────────────────────────────┐
│                     Web Server (Laravel)                    │
│  ┌──────────────────────────────────────────────────────┐  │
│  │                   Routing Layer                      │  │
│  │  - web.php: Routes untuk GKM dan GJM               │  │
│  └──────────────────────┬───────────────────────────────┘  │
│                        │                                    │
│  ┌─────────────────────┴────────────────────────────────┐  │
│  │              Middleware Layer                        │  │
│  │  - Auth: Authentication handler                     │  │
│  │  - CheckRole: Role-based access control             │  │
│  └─────────────────────┬────────────────────────────────┘  │
│                        │                                    │
│  ┌─────────────────────┴────────────────────────────────┐  │
│  │            Controller Layer                         │  │
│  │  - GKM: Dashboard, DataMaster, Monitoring, etc     │  │
│  │  - GJM: Dashboard, Recap, Validasi, Laporan       │  │
│  │  - Auth: Login, Register, Logout                   │  │
│  └─────────────────────┬────────────────────────────────┘  │
│                        │                                    │
│  ┌─────────────────────┴────────────────────────────────┐  │
│  │             Service Layer (Optional)                │  │
│  │  - LaporanService: Generate report dengan AI        │  │
│  │  - ReminderService: Manage reminder logic           │  │
│  │  - MonitoringService: Calculate compliance metrics  │  │
│  └─────────────────────┬────────────────────────────────┘  │
│                        │                                    │
│  ┌─────────────────────┴────────────────────────────────┐  │
│  │              Model Layer                            │  │
│  │  - User, Dosen, Prodi, Matakuliah                  │  │
│  │  - RPS, Materi, Monitoring                         │  │
│  │  - LaporanGKM, LaporanGJM, Kuisioner               │  │
│  │  - Reminder, LogEmail, JadwalReminder              │  │
│  └─────────────────────┬────────────────────────────────┘  │
│                        │                                    │
│  ┌─────────────────────┴────────────────────────────────┐  │
│  │                View Layer                           │  │
│  │  - Blade Templates untuk GKM dan GJM               │  │
│  │  - Bootstrap 5 untuk responsive design             │  │
│  │  - Chart.js untuk visualisasi data                 │  │
│  └──────────────────────────────────────────────────────┘  │
│                                                             │
└─────────────────┬───────────────────────────────────────────┘
                  │
┌─────────────────┴───────────────────────────────────────────┐
│                 Persistence Layer                          │
│  ┌──────────────────────────────────────────────────────┐  │
│  │              Database (MySQL/PostgreSQL)             │  │
│  │  - 16 Tabel dengan relationships                    │  │
│  │  - Indexing untuk query optimization               │  │
│  │  - Foreign keys untuk data integrity               │  │
│  └──────────────────────────────────────────────────────┘  │
│  ┌──────────────────────────────────────────────────────┐  │
│  │          Cache Layer (Optional - Redis)             │  │
│  │  - Session caching                                 │  │
│  │  - Query result caching                            │  │
│  └──────────────────────────────────────────────────────┘  │
│  ┌──────────────────────────────────────────────────────┐  │
│  │              File Storage                           │  │
│  │  - RPS, Materi, Laporan files                      │  │
│  │  - Upload ke storage/public atau cloud             │  │
│  └──────────────────────────────────────────────────────┘  │
└──────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────┐
│              External Services (Optional)                   │
│  ┌────────────────────┐  ┌──────────────┐  ┌─────────────┐ │
│  │   Email Service    │  │  AI Provider │  │  SMS Gateway│ │
│  │  (SMTP/Mailtrap)   │  │  (OpenAI API)│  │ (optional)  │ │
│  └────────────────────┘  └──────────────┘  └─────────────┘ │
└──────────────────────────────────────────────────────────────┘
```

## 3. Data Flow Architecture

### 3.1 Authentication Flow

```
User Input (Email/Password)
         ↓
[AuthController@login]
         ↓
Hash Verification
         ↓
Session Creation
         ↓
Role Check
    ├─→ GKM → [GKMDashboardController@index]
    ├─→ GJM → [GJMDashboardController@index]
    └─→ Dosen → [DashboardController@index]
```

### 3.2 Monitoring Flow

```
Dosen Upload RPS/Materi
         ↓
[API/Form Handler]
         ↓
Database Update
         ↓
[MonitoringService]
         ↓
Calculate Compliance
         ↓
Update Monitoring Table
         ↓
Check Reminder Condition
         ↓
[ReminderService]
         ↓
Send Reminder Email
         ↓
Log Email Sending
```

### 3.3 Laporan Generation Flow

```
GKM Request Laporan
         ↓
[LaporanController@generate]
         ↓
Fetch Monitoring Data
         ↓
Fetch Kuisioner Data
         ↓
[AIService]
         ↓
Generate Report (AI)
         ↓
Save to Database
         ↓
Create PDF
         ↓
Return Download
```

## 4. Model Relationships

### Hierarchy Diagram

```
User
├── isGKM (has one Dosen)
│   └── Dosen
│       ├── Prodi
│       │   ├── Matakuliah
│       │   └── LaporanGKM
│       ├── RPS
│       │   ├── Materi
│       │   └── EvaluasiArtefak
│       ├── Monitoring
│       └── Perwaliaan
├── isGJM
│   └── LaporanGJM (dibuat/disetujui)
└── isDosen
    ├── Reminder (penerima)
    └── JawabanKuisioner
```

### Key Relationships

**One-to-Many (1:n)**
- User → Reminder
- Dosen → RPS, Materi, Monitoring
- Prodi → Dosen, Matakuliah, LaporanGKM
- RPS → Materi, EvaluasiArtefak
- Kuisioner → Jawaban, Pertanyaan
- Ajaran → RPS, Monitoring, LaporanGKM

**Many-to-One (n:1)**
- Dosen → Prodi, User
- RPS → Matakuliah, Dosen, Ajaran
- Materi → RPS, Matakuliah, Dosen
- Monitoring → Dosen, Matakuliah, Ajaran

## 5. Directory Structure

```
sistem-gjk-gkm/
├── app/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Dosen.php
│   │   ├── Prodi.php
│   │   ├── Matakuliah.php
│   │   ├── Ajaran.php
│   │   ├── RPS.php
│   │   ├── Materi.php
│   │   ├── Monitoring.php
│   │   ├── Reminder.php
│   │   ├── LaporanGKM.php
│   │   ├── LaporanGJM.php
│   │   ├── Kuisioner.php
│   │   ├── PertanyaanKuisioner.php
│   │   ├── JawabanKuisioner.php
│   │   ├── EvaluasiArtefak.php
│   │   ├── LogEmail.php
│   │   ├── JadwalReminder.php
│   │   ├── Perwaliaan.php
│   │   └── PencapaianKPI.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── GKM/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── DataMasterController.php
│   │   │   │   ├── MonitoringRPSController.php
│   │   │   │   ├── MonitoringPerkuliahanController.php
│   │   │   │   ├── PelaporanController.php
│   │   │   │   └── ReminderAgentController.php
│   │   │   └── GJM/
│   │   │       ├── DashboardController.php
│   │   │       ├── RecapLaporanController.php
│   │   │       ├── ValidasiLaporanController.php
│   │   │       └── LaporanGJMController.php
│   │   └── Middleware/
│   │       └── CheckRole.php
│   ├── Services/ (optional)
│   │   ├── LaporanService.php
│   │   ├── ReminderService.php
│   │   └── MonitoringService.php
│   └── Jobs/
│       ├── SendReminderEmail.php
│       └── GenerateLaporan.php
├── database/
│   ├── migrations/
│   │   ├── 2024_02_12_000001_create_users_table.php
│   │   ├── 2024_02_12_000002_create_dosen_table.php
│   │   ├── ... (16 migration files)
│   │   └── 2024_02_12_000019_create_pencapaian_kpi_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── ProdiSeeder.php
│       └── DosenSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   ├── sidebar.blade.php
│       │   └── topbar.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── gkm/
│       │   ├── dashboard.blade.php
│       │   ├── data-master/
│       │   │   ├── index.blade.php
│       │   │   ├── dosen-pengajar.blade.php
│       │   │   ├── matakuliah.blade.php
│       │   │   └── template-laporan.blade.php
│       │   ├── monitoring-rps/
│       │   │   ├── index.blade.php
│       │   │   ├── ceklist-rps.blade.php
│       │   │   └── history-reminder.blade.php
│       │   ├── monitoring-perkuliahan/
│       │   │   ├── index.blade.php
│       │   │   ├── reminder-perwalian.blade.php
│       │   │   ├── reminder-materi.blade.php
│       │   │   └── reminder-review-soal.blade.php
│       │   ├── pelaporan/
│       │   │   ├── index.blade.php
│       │   │   ├── laporan-artefak.blade.php
│       │   │   └── laporan-kuisioner.blade.php
│       │   └── reminder-agent/
│       │       ├── index.blade.php
│       │       ├── jadwal.blade.php
│       │       └── log-email.blade.php
│       ├── gjm/
│       │   ├── dashboard.blade.php
│       │   ├── recap-laporan/
│       │   │   ├── index.blade.php
│       │   │   ├── grafik-kepatuhan.blade.php
│       │   │   └── evaluasi.blade.php
│       │   ├── validasi-laporan/
│       │   │   ├── index.blade.php
│       │   │   └── show.blade.php
│       │   └── laporan-gjm/
│       │       ├── index.blade.php
│       │       ├── laporan-bulanan.blade.php
│       │       └── laporan-tahunan.blade.php
│       └── dashboard.blade.php
├── routes/
│   └── web.php
├── public/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── uploads/
│       ├── rps/
│       ├── materi/
│       └── laporan/
├── .env.example
├── composer.json
├── package.json
├── webpack.mix.js (jika menggunakan Laravel Mix)
└── README.md
```

## 6. Security Considerations

### 6.1 Authentication
- Password hashing dengan bcrypt
- Session-based authentication
- CSRF protection pada semua form
- Rate limiting pada login attempts

### 6.2 Authorization
- Role-based access control (RBAC)
- Middleware CheckRole untuk endpoint protection
- Model-level authorization dengan Laravel policies (opsional)

### 6.3 Data Protection
- SQL Injection prevention dengan parameterized queries
- XSS prevention dengan Blade escaping
- File upload validation
- Input validation dan sanitization

## 7. Performance Optimization

### 7.1 Database
- Indexing pada frequently searched columns
- Eager loading dengan `with()` untuk reduce N+1 queries
- Pagination untuk large datasets
- Query optimization dan caching

### 7.2 Frontend
- Browser caching headers
- Minification CSS/JS
- Lazy loading untuk images
- CDN untuk static assets

### 7.3 Backend
- Redis caching untuk sessions dan queries
- Queue jobs untuk long-running tasks (email, reports)
- API response optimization
- Database connection pooling

## 8. Scalability Strategy

### 8.1 Horizontal Scaling
- Stateless application design
- Session storage di Redis/cache
- Load balancing dengan Nginx/HAProxy
- Database replication (master-slave)

### 8.2 Vertical Scaling
- Optimize database queries
- Implement caching strategies
- Async job processing dengan queues
- Memory optimization

## 9. Integration Points

### 9.1 Email Service
- SMTP untuk sending reminders
- Queue jobs untuk async delivery
- Email templates dengan Blade

### 9.2 AI Integration
- OpenAI API untuk report generation
- Custom prompt engineering
- Result caching

### 9.3 File Storage
- Local storage untuk development
- S3/Cloud storage untuk production
- File download dengan proper security headers

## 10. Testing Strategy

### 10.1 Unit Tests
```bash
php artisan test Tests/Unit/
```

### 10.2 Feature Tests
```bash
php artisan test Tests/Feature/
```

### 10.3 Test Coverage
- Authentication tests
- Authorization tests
- Model relationship tests
- Controller logic tests
- Service layer tests

## 11. Deployment Architecture

### Production Stack
```
Browser
   ↓
CDN (Static Assets)
   ↓
Nginx (Load Balancer)
   ↓
Laravel App (Multiple Instances)
   ↓
MySQL (Master-Slave Replication)
   ↓
Redis (Cache & Queue)
   ↓
Supervisor (Queue Worker)
   ↓
Monitoring & Logging (ELK Stack, Sentry)
```

## 12. Monitoring & Logging

### Metrics to Track
- Application uptime
- Database query performance
- Queue job success/failure rates
- Email delivery success rate
- User login/activity logs
- Error rates

### Tools
- Laravel Telescope (development)
- Sentry (error tracking)
- ELK Stack (centralized logging)
- New Relic/DataDog (APM)

---

**Dokumen ini akan di-update seiring dengan development progression.**
