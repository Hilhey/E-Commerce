<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /admin/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Menu Utama Admin</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <section class="section">
    <div class="container">
      <h2>Menu Utama Admin</h2>
      <div class="card">
        <p>Selamat datang, <?= htmlspecialchars($_SESSION['username']) ?>. Anda dapat mengelola data produk dan profil.</p>
        <ul>
          <li>Kelola katalog produk (CRUD).</li>
          <li>Perbarui profil mahasiswa.</li>
          <li>Logout dengan aman.</li>
        </ul>
      </div>
    </div>
  </section>
</body>
</html>
