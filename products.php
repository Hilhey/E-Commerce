<?php
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/db.php';

$products = [];
$query = "SELECT id, name, description, price, category, image_url FROM `muhammad hilman` ORDER BY id DESC";
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $result->free();
}
?>

<section class="section">
  <div class="container">
    <h2>Katalog Produk</h2>
    <p>Produk fisik dan digital pilihan yang diambil dari database <strong>BD</strong>.</p>
    <div class="product-grid">
      <?php foreach ($products as $product): ?>
        <div class="product-card">
          <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width:100%; border-radius:10px;">
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <p><?= htmlspecialchars($product['description']) ?></p>
          <p><span class="badge"><?= htmlspecialchars($product['category']) ?></span></p>
          <strong>Rp <?= number_format((float)$product['price'], 0, ',', '.') ?></strong>
        </div>
      <?php endforeach; ?>
      <?php if (empty($products)): ?>
        <div class="card">
          <p>Data produk belum tersedia. Silakan impor dari file SQL.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
