<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /admin/login.php');
    exit();
}

include __DIR__ . '/../includes/db.php';

$action = $_GET['action'] ?? '';
$id = (int)($_GET['id'] ?? 0);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $category = trim($_POST['category'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');

    if (!empty($_POST['id'])) {
        $stmt = $mysqli->prepare("UPDATE `muhammad hilman` SET name=?, description=?, price=?, category=?, image_url=? WHERE id=?");
        $stmt->bind_param('ssdssi', $name, $description, $price, $category, $image_url, $_POST['id']);
        $stmt->execute();
        $stmt->close();
        $message = 'Produk berhasil diperbarui.';
    } else {
        $stmt = $mysqli->prepare("INSERT INTO `muhammad hilman` (name, description, price, category, image_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssdss', $name, $description, $price, $category, $image_url);
        $stmt->execute();
        $stmt->close();
        $message = 'Produk berhasil ditambahkan.';
    }
}

if ($action === 'delete' && $id) {
    $stmt = $mysqli->prepare("DELETE FROM `muhammad hilman` WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    $message = 'Produk berhasil dihapus.';
}

$editProduct = null;
if ($action === 'edit' && $id) {
    $result = $mysqli->query("SELECT * FROM `muhammad hilman` WHERE id=$id");
    $editProduct = $result->fetch_assoc();
}

$products = [];
$result = $mysqli->query("SELECT * FROM `muhammad hilman` ORDER BY id DESC");
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Produk CRUD</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <section class="section">
    <div class="container">
      <h2>Kelola Produk</h2>
      <?php if ($message): ?>
        <div class="notice"><?= htmlspecialchars($message) ?></div>
      <?php endif; ?>
      <div class="card">
        <form method="POST">
          <input type="hidden" name="id" value="<?= htmlspecialchars($editProduct['id'] ?? '') ?>">
          <label>Nama Produk</label>
          <input class="form-control" type="text" name="name" value="<?= htmlspecialchars($editProduct['name'] ?? '') ?>" required>
          <label>Deskripsi</label>
          <textarea class="form-control" name="description" required><?= htmlspecialchars($editProduct['description'] ?? '') ?></textarea>
          <label>Harga</label>
          <input class="form-control" type="number" name="price" step="0.01" value="<?= htmlspecialchars($editProduct['price'] ?? '') ?>" required>
          <label>Kategori</label>
          <input class="form-control" type="text" name="category" value="<?= htmlspecialchars($editProduct['category'] ?? '') ?>" required>
          <label>URL Gambar</label>
          <input class="form-control" type="text" name="image_url" value="<?= htmlspecialchars($editProduct['image_url'] ?? '') ?>" required>
          <button class="button" type="submit">Simpan</button>
        </form>
      </div>
      <h3 style="margin-top:24px">Daftar Produk</h3>
      <table class="table">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product): ?>
            <tr>
              <td><?= htmlspecialchars($product['name']) ?></td>
              <td><?= htmlspecialchars($product['category']) ?></td>
              <td>Rp <?= number_format((float)$product['price'], 0, ',', '.') ?></td>
              <td>
                <a href="/admin/products.php?action=edit&id=<?= $product['id'] ?>">Edit</a> |
                <a href="/admin/products.php?action=delete&id=<?= $product['id'] ?>" onclick="return confirm('Hapus produk ini?')">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <?php if (empty($products)): ?>
            <tr><td colspan="4">Belum ada produk.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </section>
</body>
</html>
