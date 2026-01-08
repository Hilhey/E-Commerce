<?php
require __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

if (!$pdo) {
    echo json_encode([
        'error' => $dbError ?: 'Koneksi database gagal.',
        'products' => [],
    ]);
    exit;
}

$stmt = $pdo->query('SELECT id, nama_produk, deskripsi, harga, gambar, kategori FROM bisnis_digital ORDER BY id DESC');
$products = $stmt->fetchAll();

echo json_encode([
    'error' => null,
    'products' => $products,
]);
