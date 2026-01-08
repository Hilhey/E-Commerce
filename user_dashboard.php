<?php
include __DIR__ . '/includes/header.php';
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: /login.php');
    exit();
}
?>

<section class="section">
  <div class="container">
    <h2>Halo, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <div class="card">
      <p>Selamat berbelanja di Digipreneur. Berikut fitur khusus user:</p>
      <ul>
        <li>Melihat katalog produk.</li>
        <li>Mendapatkan rekomendasi produk.</li>
        <li>Menyimpan wishlist.</li>
      </ul>
      <a class="button" href="/products.php">Belanja Sekarang</a>
      <a class="button" style="background:#64748b" href="/logout.php">Logout</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
