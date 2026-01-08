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
  <title>Profile Mahasiswa</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <section class="section">
    <div class="container">
      <h2>Profile Mahasiswa</h2>
      <div class="card">
        <img src="https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=500&q=60" alt="Foto Mahasiswa" style="width:100%; border-radius:10px;">
        <h3>Muhammad Hilman</h3>
        <p>Program Studi: Sistem Informasi</p>
        <p>Minat: E-commerce, UI/UX, dan Produk Digital.</p>
      </div>
    </div>
  </section>
</body>
</html>
