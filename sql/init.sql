CREATE DATABASE IF NOT EXISTS BD;
USE BD;

CREATE TABLE IF NOT EXISTS `muhammad hilman` (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(12,2) NOT NULL,
  category VARCHAR(50) NOT NULL,
  image_url VARCHAR(255) NOT NULL
);

INSERT INTO `muhammad hilman` (name, description, price, category, image_url) VALUES
('E-Book Strategi UMKM', 'Panduan digital untuk meningkatkan penjualan online.', 75000, 'Digital', 'https://images.unsplash.com/photo-1520607162513-77705c0f0d4a?auto=format&fit=crop&w=600&q=60'),
('Paket Branding Visual', 'Template desain logo dan media sosial.', 150000, 'Digital', 'https://images.unsplash.com/photo-1521791055366-0d553872125f?auto=format&fit=crop&w=600&q=60'),
('Starter Kit Kemasan', 'Set kemasan fisik untuk produk makanan.', 120000, 'Fisik', 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=60');
