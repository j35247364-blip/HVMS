<?php
require_once __DIR__ . '/includes/auth.php';
if (is_logged_in()) { header('Location: dashboard.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id']   = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role']      = $user['role'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Incorrect username or password. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign in · Coral Cove HVMS</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="login-wrap">
  <svg class="horizon" viewBox="0 0 1440 200" preserveAspectRatio="none">
    <path d="M0,120 C240,180 480,60 720,110 C960,160 1200,60 1440,100 L1440,200 L0,200 Z" fill="#0B2B3C" opacity="0.55"/>
    <path d="M0,150 C240,100 480,170 720,140 C960,110 1200,180 1440,150 L1440,200 L0,200 Z" fill="#15707A" opacity="0.65"/>
  </svg>

  <div class="login-card">
    <span class="brand-wave">~</span>
    <h1>Coral Cove</h1>
    <p class="sub">Visitor Management · Ocean View Hotel</p>

    <?php if ($error): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required autofocus placeholder="e.g. admin">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required placeholder="••••••••">
      </div>
      <button type="submit" class="btn btn-primary">Sign in</button>
    </form>

    <p class="login-hint">Default admin login — username: <strong>admin</strong>, password: <strong>admin123</strong></p>
  </div>
</div>
</body>
</html>
