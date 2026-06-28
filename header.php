<?php
require_once __DIR__ . '/auth.php';
$u = current_user();
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($page_title) ? htmlspecialchars($page_title) . ' · ' : '' ?>Coral Cove HVMS</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="app-shell">
  <aside class="sidebar">
    <div class="brand">
      <span class="brand-wave">~</span>
      <div class="brand-text">
        <strong>Coral Cove</strong>
        <small>Visitor Management</small>
      </div>
    </div>

    <nav class="nav-links">
      <a href="dashboard.php" class="<?= $current_page=='dashboard.php'?'active':'' ?>"><span class="ico">⌂</span> Dashboard</a>
      <a href="register_visitor.php" class="<?= $current_page=='register_visitor.php'?'active':'' ?>"><span class="ico">＋</span> Register Visitor</a>
      <a href="visitors.php" class="<?= $current_page=='visitors.php'?'active':'' ?>"><span class="ico">⌕</span> View / Search</a>
      <a href="bookings.php" class="<?= $current_page=='bookings.php'?'active':'' ?>"><span class="ico">🛏</span> Online Bookings</a>
      <a href="reports.php" class="<?= $current_page=='reports.php'?'active':'' ?>"><span class="ico">▤</span> Reports</a>
      <a href="functionalities.php" class="<?= $current_page=='functionalities.php'?'active':'' ?>"><span class="ico">≡</span> Functionalities</a>
      <?php if ($u['role'] === 'admin'): ?>
      <a href="admin.php" class="<?= ($current_page=='admin.php'||$current_page=='admin_users.php')?'active':'' ?>"><span class="ico">⚙</span> Admin</a>
      <?php endif; ?>
      <a href="help.php" class="<?= $current_page=='help.php'?'active':'' ?>"><span class="ico">?</span> Help</a>
    </nav>

    <div class="sidebar-footer">
      <div class="user-chip">
        <div class="avatar"><?= htmlspecialchars(strtoupper(substr($u['name'] ?: 'U',0,1))) ?></div>
        <div>
          <div class="user-name"><?= htmlspecialchars($u['name']) ?></div>
          <div class="user-role"><?= htmlspecialchars(ucfirst($u['role'])) ?></div>
        </div>
      </div>
      <a href="logout.php" class="logout-link">Log out</a>
    </div>
  </aside>

  <main class="main-area">
