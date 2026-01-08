<?php
require __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

if (!$pdo) {
    echo json_encode([
        'error' => $dbError ?: 'Koneksi database gagal.',
        'product' => null,
    ]);
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT id, nama_produk, deskripsi, harga, gambar, kategori FROM bisnis_digital WHERE id = :id');
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    http_response_code(404);
    echo json_encode([
        'error' => 'Produk tidak ditemukan.',
        'product' => null,
    ]);
    exit;
}

echo json_encode([
    'error' => null,
    'product' => $product,
]);
