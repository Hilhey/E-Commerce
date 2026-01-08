<?php
include __DIR__ . '/includes/header.php';

$errors = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? 'user';
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $accounts = [
        'admin' => ['username' => 'admin', 'password' => 'admin123'],
        'user' => ['username' => 'user', 'password' => 'user123'],
    ];

    if (isset($accounts[$role]) && $accounts[$role]['username'] === $username && $accounts[$role]['password'] === $password) {
        $_SESSION['role'] = $role;
        $_SESSION['username'] = $username;
        if ($role === 'admin') {
            header('Location: /admin/frame.php');
            exit();
        }
        header('Location: /user_dashboard.php');
        exit();
    }

    $errors = 'Login gagal. Periksa kembali username dan password.';
}
?>

<section class="section">
  <div class="container">
    <h2>Login Pengguna</h2>
    <div class="card" style="max-width:420px;">
      <?php if ($errors): ?>
        <div class="notice"><?= htmlspecialchars($errors) ?></div>
      <?php endif; ?>
      <form method="POST">
        <label>Role</label>
        <select name="role" class="form-control">
          <option value="user">User Belanja</option>
          <option value="admin">Admin</option>
        </select>
        <label>Username</label>
        <input class="form-control" type="text" name="username" required>
        <label>Password</label>
        <input class="form-control" type="password" name="password" required>
        <button class="button" type="submit">Masuk</button>
      </form>
      <p style="margin-top:12px">Contoh akun: <strong>user/user123</strong> atau <strong>admin/admin123</strong>.</p>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
