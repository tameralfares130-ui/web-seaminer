<?php require_once __DIR__ . '/../app/functions.php'; $u = current_user(); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= APP_NAME ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/validation.js" defer></script>
</head>
<body>
<header class="site-header">
  <div class="header-top">
    <div>
      <h1>Student Grade Portal</h1>
      <p>Responsive PHP web application for school marks, subjects and students</p>
    </div>
    <div class="login-status">
      <?php if ($u): ?>
        Logged-in: <strong><?= h($u['family_name']) ?> <?= h($u['surname']) ?> (<?= h($u['login_name']) ?>)</strong>
      <?php else: ?>
        Not logged in
      <?php endif; ?>
    </div>
  </div>
  <nav class="menu">
    <a href="index.php?route=home">Mainpage</a>
    <a href="index.php?route=images">Images</a>
    <a href="index.php?route=contact">Contact</a>
    <a href="index.php?route=crud">CRUD</a>
    <?php if ($u): ?>
      <a href="index.php?route=messages">Messages</a>
      <a href="index.php?route=logout">Logout</a>
    <?php else: ?>
      <a href="index.php?route=login">Login</a>
    <?php endif; ?>
  </nav>
</header>
<main class="container">
<?php if ($m = flash('success')): ?><div class="alert success"><?= h($m) ?></div><?php endif; ?>
<?php if ($m = flash('error')): ?><div class="alert error"><?= h($m) ?></div><?php endif; ?>
