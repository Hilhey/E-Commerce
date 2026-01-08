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
  <title>Dashboard Admin</title>
</head>
<frameset cols="240,*">
  <frame src="/admin/menu.php" name="menu">
  <frame src="/admin/home.php" name="content">
</frameset>
</html>
