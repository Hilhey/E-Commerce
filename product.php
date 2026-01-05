<?php
require __DIR__ . '/config/db.php';

if (!$pdo) {
    http_response_code(500);
    echo $dbError ? htmlspecialchars($dbError) : 'Koneksi database gagal.';
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT id, nama_produk, deskripsi, harga, gambar, kategori FROM bisnis_digital WHERE id = :id');
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    http_response_code(404);
    echo 'Produk tidak ditemukan.';
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['nama_produk']) ?> - Bisnis Digital Store</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="sub-hero">
        <nav class="navbar">
            <a class="logo" href="index.php">Bisnis<span>Digital</span></a>
            <div class="nav-actions">
                <a class="ghost-btn" href="index.php">Kembali</a>
            </div>
        </nav>
    </header>

    <main class="section product-detail">
        <div class="detail-image">
            <img src="<?= htmlspecialchars($product['gambar'] ?: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80') ?>" alt="<?= htmlspecialchars($product['nama_produk']) ?>">
        </div>
        <div class="detail-info">
            <span class="tag"><?= htmlspecialchars($product['kategori'] ?: 'Digital') ?></span>
            <h1><?= htmlspecialchars($product['nama_produk']) ?></h1>
            <p><?= htmlspecialchars($product['deskripsi']) ?></p>
            <div class="detail-price">Rp <?= number_format($product['harga'], 0, ',', '.') ?></div>
            <button class="primary-btn add-to-cart" data-id="<?= (int) $product['id'] ?>" data-name="<?= htmlspecialchars($product['nama_produk']) ?>" data-price="<?= (float) $product['harga'] ?>">Tambah ke Keranjang</button>
        </div>
    </main>

    <script src="assets/js/app.js"></script>
</body>
</html>
