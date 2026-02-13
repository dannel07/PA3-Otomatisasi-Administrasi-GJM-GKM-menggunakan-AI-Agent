# Troubleshooting Panduan - Error 500

Jika Anda mengalami error 500 saat menjalankan aplikasi, ikuti langkah-langkah berikut:

## 1. Clear Cache & Optimize

```bash
# Clear semua cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Optimize aplikasi
php artisan optimize
```

## 2. Check .env File

Pastikan `.env` sudah ada dan dikonfigurasi dengan benar:

```bash
# Copy dari example jika belum ada
cp .env.example .env

# Generate APP_KEY
php artisan key:generate
```

## 3. Database Migration

Pastikan database sudah dimigrate:

```bash
# Run migrations
php artisan migrate

# Jika ada error, reset dan run ulang
php artisan migrate:reset
php artisan migrate
```

## 4. Database Seeding (Optional)

Untuk menambahkan demo data:

```bash
php artisan db:seed
```

## 5. Check Log Files

Lihat detail error di log file:

```bash
# Linux/Mac
tail -f storage/logs/laravel.log

# Windows PowerShell
Get-Content storage/logs/laravel.log -Tail 50 -Wait
```

## 6. Debug Mode

Untuk melihat error detail lebih jelas:

1. Edit `.env`:
```env
APP_DEBUG=true
```

2. Reload aplikasi - error detail akan tampil di browser

**PERHATIAN**: Jangan gunakan `APP_DEBUG=true` di production!

## 7. Common Issues & Solutions

### Error: "No application encryption key has been specified"
```bash
php artisan key:generate
```

### Error: "SQLSTATE - could not find driver"
Pastikan PHP memiliki extension yang diperlukan:
```bash
# Check php extensions
php -m | grep -i sqlite    # Untuk SQLite
php -m | grep -i mysql     # Untuk MySQL
```

### Error: "Table not found"
```bash
# Run migrations
php artisan migrate

# Jika belum ada migration table
php artisan migrate:install
php artisan migrate
```

### Error: "Class not found"
```bash
# Regenerate autoloader
composer dump-autoload

# Clear compiled files
php artisan clear-compiled
```

### Permission Denied Errors
```bash
# Linux/Mac - Pastikan folder writable
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

## 8. Verify Installation

Run diagnostic command:

```bash
# Check Laravel version
php artisan --version

# List routes
php artisan route:list

# Show environment info
php artisan --info
```

## 9. Reinstall dari Scratch

Jika masalah persistent, coba reinstall:

```bash
# 1. Clear vendor
rm -rf vendor/
rm -rf node_modules/

# 2. Reinstall dependencies
composer install

# 3. Setup
cp .env.example .env
php artisan key:generate

# 4. Database
php artisan migrate
php artisan db:seed

# 5. Run
php artisan serve
```

## 10. Browser DevTools Check

Buka Browser DevTools (F12):

1. **Console Tab** - Lihat JavaScript errors
2. **Network Tab** - Check HTTP response codes
3. **Application Tab** - Check cookies & storage

## 11. Check Application Routes

```bash
# List semua routes
php artisan route:list

# Filter routes
php artisan route:list --path=gkm
php artisan route:list --path=gjm
```

## 12. Database Connection Test

```bash
# Test koneksi database
php artisan tinker
# Ketik: DB::connection()->getPdo();
# Jika sukses, tidak ada error
```

## 13. Views & Assets Check

Pastikan views folder structure:
```
resources/
└── views/
    ├── auth/
    │   ├── login.blade.php
    │   └── register.blade.php
    ├── gkm/
    │   ├── dashboard/
    │   ├── data-master/
    │   ├── monitoring-rps/
    │   ├── monitoring-perkuliahan/
    │   ├── pelaporan/
    │   └── reminder-agent/
    ├── gjm/
    │   ├── dashboard/
    │   ├── recap-laporan/
    │   ├── validasi-laporan/
    │   └── laporan-gjm/
    └── layouts/
        └── app.blade.php
```

## 14. Model & Controller Verification

```bash
# Check model relationships
php artisan tinker
# Ketik: App\Models\User::all();
```

## 15. Server Configuration

### Apache (.htaccess)
Pastikan file `public/.htaccess` ada dengan content:
```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>
    RewriteEngine On
    RewriteCond %{HTTP:Authorization} .
    RewriteRule ^(.*)$ public/$1 [L]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} !^/index.php
    RewriteRule ^(.*)$ index.php [L]
</IfModule>
```

### Nginx
Pastikan konfigurasi:
```nginx
location ~ \.php$ {
    fastcgi_pass unix:/var/run/php-fpm.sock;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    include fastcgi_params;
}

location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

## 16. Memory & Timeout Issues

Increase PHP limits di `php.ini` atau `.htaccess`:

```ini
memory_limit = 256M
max_execution_time = 300
upload_max_filesize = 100M
post_max_size = 100M
```

## 17. Get Help

Jika masih error, kumpulkan informasi:

1. Error message dari log file
2. Output dari `php artisan --info`
3. PHP version (`php -v`)
4. Database version
5. Laravel version (`php artisan --version`)

Kemudian share informasi tersebut untuk debugging lebih lanjut.

## Quick Checklist

- [ ] APP_KEY ada di .env
- [ ] Database migrations dijalankan
- [ ] Tables ada di database
- [ ] Views folder structure benar
- [ ] Controllers ada di app/Http/Controllers/
- [ ] Routes di routes/web.php
- [ ] Storage folder writable
- [ ] bootstrap/cache folder writable
- [ ] PHP extensions lengkap
- [ ] Composer dependencies installed

Jika semua checklist sudah ok, aplikasi seharusnya berjalan normal!

---

**Butuh bantuan lebih lanjut?** Hubungi tim development dengan screenshot error dan log file.
