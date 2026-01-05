<?php
require __DIR__ . '/config/db.php';

$products = [];
if ($pdo) {
    $stmt = $pdo->query('SELECT id, nama_produk, deskripsi, harga, gambar, kategori FROM bisnis_digital ORDER BY id DESC');
    $products = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bisnis Digital Store</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="hero">
        <nav class="navbar">
            <div class="logo">Bisnis<span>Digital</span></div>
            <div class="nav-actions">
                <input type="text" id="searchInput" placeholder="Cari produk...">
                <button class="cart-btn" id="cartToggle">Keranjang <span id="cartCount">0</span></button>
            </div>
        </nav>
        <div class="hero-content">
            <h1>Platform E-Commerce Produk Digital</h1>
            <p>Temukan template, kursus, dan tools digital terbaik untuk bisnis Anda.</p>
            <button class="primary-btn">Mulai Belanja</button>
        </div>
    </header>

    <section class="section">
        <div class="section-header">
            <h2>Produk Unggulan</h2>
            <p>Update koleksi terbaru dari kreator pilihan.</p>
        </div>
        <?php if ($dbError) : ?>
            <div class="notice">
                <strong>Info:</strong> <?= htmlspecialchars($dbError) ?>
            </div>
        <?php endif; ?>
        <div class="product-grid" id="productGrid">
            <?php if (empty($products)) : ?>
                <div class="empty-state">
                    <p>Belum ada produk di database. Jalankan file SQL untuk menambahkan data contoh.</p>
                </div>
            <?php else : ?>
                <?php foreach ($products as $product) : ?>
                    <article class="product-card" data-name="<?= htmlspecialchars($product['nama_produk']) ?>">
                        <div class="product-image">
                            <img src="<?= htmlspecialchars($product['gambar'] ?: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=800&q=80') ?>" alt="<?= htmlspecialchars($product['nama_produk']) ?>">
                            <span class="tag"><?= htmlspecialchars($product['kategori'] ?: 'Digital') ?></span>
                        </div>
                        <div class="product-info">
                            <h3><?= htmlspecialchars($product['nama_produk']) ?></h3>
                            <p><?= htmlspecialchars($product['deskripsi']) ?></p>
                            <div class="product-meta">
                                <span class="price">Rp <?= number_format($product['harga'], 0, ',', '.') ?></span>
                                <div class="actions">
                                    <a href="product.php?id=<?= (int) $product['id'] ?>" class="ghost-btn">Detail</a>
                                    <button class="primary-btn add-to-cart" data-id="<?= (int) $product['id'] ?>" data-name="<?= htmlspecialchars($product['nama_produk']) ?>" data-price="<?= (float) $product['harga'] ?>">Tambah</button>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

    <section class="section highlight">
        <div class="highlight-content">
            <h2>Siap menaikkan omzet?</h2>
            <p>Dapatkan insight, template, dan strategi marketing dengan sekali klik.</p>
            <button class="primary-btn">Langganan Newsletter</button>
        </div>
        <div class="highlight-card">
            <h3>Kenapa memilih kami?</h3>
            <ul>
                <li>Produk digital berkualitas dan terkurasi</li>
                <li>Akses instan setelah pembelian</li>
                <li>Dukungan komunitas kreator</li>
            </ul>
        </div>
    </section>

    <aside class="cart-panel" id="cartPanel">
        <div class="cart-header">
            <h3>Keranjang Belanja</h3>
            <button id="closeCart">Tutup</button>
        </div>
        <div class="cart-body" id="cartItems"></div>
        <div class="cart-footer">
            <div class="total">Total: <span id="cartTotal">Rp 0</span></div>
            <button class="primary-btn" id="checkoutBtn">Checkout</button>
        </div>
    </aside>

    <footer class="footer">
        <div>
            <h4>Bisnis Digital Store</h4>
            <p>Solusi e-commerce modern untuk produk digital.</p>
        </div>
        <div>
            <h4>Kontak</h4>
            <p>Email: hello@bisnisdigital.id</p>
            <p>Instagram: @bisnisdigital</p>
        </div>
    </footer>

    <script src="assets/js/app.js"></script>
</body>
</html>
