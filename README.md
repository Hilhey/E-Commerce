# Bisnis Digital Store

Website e-commerce sederhana berbasis PHP + MySQL untuk produk digital. Desain modern dengan fitur pencarian dan keranjang belanja menggunakan JavaScript.

## Struktur Folder

```
.
├── assets
│   ├── css
│   │   └── style.css         # Styling utama tampilan
│   └── js
│       └── app.js            # Interaksi UI (search, cart)
├── config
│   └── db.php                # Konfigurasi koneksi database MySQL
├── database
│   └── schema.sql            # Struktur tabel dan data contoh
├── index.php                 # Halaman utama daftar produk
├── product.php               # Halaman detail produk
└── README.md                 # Dokumentasi proyek
```

## Cara Menjalankan

1. Buat database MySQL baru (contoh: `ecommerce`).
2. Jalankan file `database/schema.sql` untuk membuat tabel `bisnis_digital` dan mengisi data contoh.
3. Atur kredensial database di `config/db.php`.
4. Jalankan server PHP, misalnya:

```bash
php -S localhost:8000
```

Buka `http://localhost:8000` di browser.

## Catatan

- Keranjang disimpan di `localStorage` melalui JavaScript.
- Gambar produk menggunakan URL eksternal dari Unsplash.
