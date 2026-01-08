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
  <title>Menu Admin</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body class="frameset-body">
  <div class="admin-menu">
    <h3>Admin Panel</h3>
    <a href="/admin/home.php" target="content">Menu Utama Admin</a>
    <a href="/admin/products.php" target="content">Produk (CRUD)</a>
    <a href="/admin/profile.php" target="content">Profile Mahasiswa</a>
    <a href="/admin/logout.php" target="content">Logout</a>
  </div>
</body>
</html>
