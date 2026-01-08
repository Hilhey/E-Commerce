<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Digipreneur</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
<header>
  <div class="container navbar">
    <img src="/assets/logo.svg" alt="Logo Digipreneur" height="40">
    <ul class="nav-links">
      <li><a href="/index.php">Home</a></li>
      <li><a href="/products.php">Produk</a></li>
      <li><a href="/profile.php">Profil Perusahaan</a></li>
      <li><a href="/free.php">Menu Bebas</a></li>
      <li><a href="/login.php">Login</a></li>
      <li><a href="/admin/login.php">Admin</a></li>
    </ul>
  </div>
</header>
