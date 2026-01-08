<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <section class="section">
    <div class="container">
      <h2>Logout</h2>
      <div class="card">
        <p>Anda telah logout dari admin.</p>
        <a class="button" href="/index.php" target="_top">Kembali ke Home</a>
      </div>
    </div>
  </section>
</body>
</html>
