# Digipreneur - Portal E-Commerce & Katalog Produk Digital

Aplikasi web bisnis berbasis HTML, CSS, JavaScript, dan PHP dengan tema produk fisik/digital.

## Prasyarat
- PHP 8+ (untuk menjalankan aplikasi)
- MySQL/MariaDB (untuk database)

## Setup Database
1. Buat database `BD` dan tabel `muhammad hilman` dengan data awal:
   ```bash
   mysql -u root -p < sql/init.sql
   ```
2. Pastikan kredensial database sesuai pada `includes/db.php` (default `root` tanpa password).

## Menjalankan Aplikasi
1. Jalankan server PHP built-in:
   ```bash
   php -S 0.0.0.0:8000 -t .
   ```
2. Buka aplikasi di browser:
   - Public site: `http://localhost:8000/index.php`
   - Admin login: `http://localhost:8000/admin/login.php`

## Akun Demo
- Admin: `admin / admin123`
- User: `user / user123`

## Struktur Utama
- `index.php` : Home
- `products.php` : Produk (data dari database)
- `profile.php` : Profil Perusahaan
- `free.php` : Menu Bebas
- `login.php` : Login user/admin
- `admin/` : Dashboard admin berbasis frame + CRUD produk
- `sql/init.sql` : Skrip database
