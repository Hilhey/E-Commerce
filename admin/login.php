<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['role'] = 'admin';
        $_SESSION['username'] = $username;
        header('Location: /admin/frame.php');
        exit();
    }
    $error = 'Login admin gagal.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <section class="section">
    <div class="container">
      <h2>Login Admin</h2>
      <div class="card" style="max-width:420px;">
        <?php if ($error): ?>
          <div class="notice"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
          <label>Username</label>
          <input class="form-control" type="text" name="username" required>
          <label>Password</label>
          <input class="form-control" type="password" name="password" required>
          <button class="button" type="submit">Masuk</button>
        </form>
      </div>
    </div>
  </section>
</body>
</html>
