CREATE TABLE IF NOT EXISTS bisnis_digital (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(120) NOT NULL,
    deskripsi TEXT NOT NULL,
    harga DECIMAL(12, 2) NOT NULL,
    gambar VARCHAR(255) DEFAULT NULL,
    kategori VARCHAR(80) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO bisnis_digital (nama_produk, deskripsi, harga, gambar, kategori) VALUES
('Template Landing Page', 'Template modern untuk promosi produk digital dengan layout responsif.', 129000, 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?auto=format&fit=crop&w=800&q=80', 'Template'),
('Kursus Instagram Marketing', 'Video course strategi iklan dan konten untuk bisnis online.', 249000, 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=800&q=80', 'Course'),
('Paket UI Kit Mobile', 'Koleksi UI kit premium untuk aplikasi mobile dan SaaS.', 199000, 'https://images.unsplash.com/photo-1555099962-4199c345e5dd?auto=format&fit=crop&w=800&q=80', 'UI Kit');
