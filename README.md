# Bisnis Digital Store

Website e-commerce sederhana berbasis PHP + MySQL untuk produk digital. Halaman utama menggunakan HTML dengan data produk dimuat via JavaScript dari API PHP.

## Struktur Folder

```
.
├── api
│   ├── product.php           # API detail produk (JSON)
│   └── products.php          # API daftar produk (JSON)
├── assets
│   ├── css
│   │   └── style.css          # Styling utama tampilan
│   └── js
│       └── app.js             # Interaksi UI (search, cart, fetch API)
├── config
│   └── db.php                 # Konfigurasi koneksi database MySQL
├── database
│   └── schema.sql             # Struktur tabel dan data contoh
├── index.html                 # Halaman utama daftar produk
├── product.html               # Halaman detail produk
└── README.md                  # Dokumentasi proyek
```

## Cara Menjalankan

1. Buat database MySQL baru (contoh: `ecommerce`).
2. Jalankan file `database/schema.sql` untuk membuat tabel `bisnis_digital` dan mengisi data contoh.
3. Atur kredensial database di `config/db.php`.
4. Jalankan server PHP, misalnya:

```bash
php -S localhost:8000
```

Buka `http://localhost:8000/index.html` di browser.

## Catatan

- Keranjang disimpan di `localStorage` melalui JavaScript.
- Gambar produk menggunakan URL eksternal dari Unsplash.
