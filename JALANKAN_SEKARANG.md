# JALANKAN APLIKASI SEKARANG

## Langkah 1: Setup Database

```bash
php artisan migrate:fresh --seed
```

## Langkah 2: Jalankan Server

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Langkah 3: Login dengan User Demo

**Akun GKM:**
- Email: `gkm@example.com`
- Password: `password`

**Akun GJM:**
- Email: `gjm@example.com`
- Password: `password`

## Atau Register Akun Baru

1. Buka `/register`
2. Isi form:
   - Nama Lengkap
   - Email
   - Pilih Tipe User (GKM atau GJM)
   - Password (minimal 8 karakter)
3. Klik Daftar

## Perbaikan yang Sudah Dilakukan

✅ AuthController - Field `nama_user` → `name`  
✅ AuthController - Hapus field `no_identitas` (tidak diperlukan)  
✅ Register View - Update form fields  
✅ User Model - Standardize fields  
✅ Migration Prodi - Renamed ke 2024_02_12_000000  
✅ Migration Foreign Key - Tambah constraint kaprodi_id  

## Jika Masih Ada Error

Baca file `TROUBLESHOOTING.md` untuk solusi error 500 lainnya.

## Struktur Aplikasi

```
/resources
  /views
    /auth        → Login & Register
    /gkm         → GKM Dashboard & Module
    /gjm         → GJM Dashboard & Module
    /layouts     → Layout templates

/app
  /Models        → Database models
  /Http
    /Controllers → Business logic
    /Middleware  → Auth & role middleware

/database
  /migrations    → Database schema
  /seeders       → Demo data
```

Happy coding!
