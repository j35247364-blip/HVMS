<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
$page_title = 'Dashboard';

$total      = $pdo->query("SELECT COUNT(*) FROM visitors")->fetchColumn();
$pending    = $pdo->query("SELECT COUNT(*) FROM visitors WHERE status='Pending'")->fetchColumn();
$checkedin  = $pdo->query("SELECT COUNT(*) FROM visitors WHERE status='Checked In'")->fetchColumn();
$today      = $pdo->query("SELECT COUNT(*) FROM visitors WHERE DATE(created_at) = CURDATE()")->fetchColumn();
$newBookings = $pdo->query("SELECT COUNT(*) FROM bookings WHERE status='Pending'")->fetchColumn();

$recent = $pdo->query("SELECT * FROM visitors ORDER BY created_at DESC LIMIT 8")->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Coral Cove · Ocean View</span>
    <h1>Welcome back, <?= htmlspecialchars(explode(' ', current_user()['name'])[0]) ?></h1>
    <p>Here's what's happening at the front desk right now — <span class="live-clock"></span></p>
  </div>
  <a href="register_visitor.php" class="btn btn-primary">＋ Register Visitor</a>
</div>

<div class="stats-row">
  <div class="stat-card"><div class="num"><?= $total ?></div><div class="label">Total Records</div></div>
  <div class="stat-card coral"><div class="num"><?= $pending ?></div><div class="label">Pending Check-in</div></div>
  <div class="stat-card"><div class="num"><?= $checkedin ?></div><div class="label">Currently On-site</div></div>
  <div class="stat-card"><div class="num"><?= $today ?></div><div class="label">Registered Today</div></div>
</div>

<div class="card" style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
  <div>
    <h2 style="margin-bottom:4px;">🛏 New Online Booking Requests: <?= $newBookings ?></h2>
    <p style="margin:0; color:var(--muted); font-size:13px;">Guests can book directly from the public website — confirming a request adds them to the visitor log.</p>
  </div>
  <a href="bookings.php" class="btn btn-primary">Review Bookings</a>
</div>

<div class="card">
  <h2>Recent Visitor Activity</h2>
  <table>
    <thead>
      <tr><th>Visitor</th><th>Purpose</th><th>Host / Room</th><th>Check-in</th><th>Status</th></tr>
    </thead>
    <tbody>
      <?php if (!$recent): ?>
        <tr><td colspan="5" style="text-align:center; color:var(--muted); padding:24px;">No visitors logged yet. Register your first visitor to get started.</td></tr>
      <?php endif; ?>
      <?php foreach ($recent as $v): ?>
        <tr>
          <td><strong><?= htmlspecialchars($v['full_name']) ?></strong></td>
          <td><?= htmlspecialchars($v['purpose']) ?></td>
          <td><?= htmlspecialchars($v['host_name']) ?> <?= $v['room_number'] ? '(' . htmlspecialchars($v['room_number']) . ')' : '' ?></td>
          <td><?= $v['check_in_time'] ? date('d M, H:i', strtotime($v['check_in_time'])) : '—' ?></td>
          <td>
            <?php $cls = strtolower(str_replace(' ', '', $v['status'])); ?>
            <span class="badge <?= $cls ?>"><?= htmlspecialchars($v['status']) ?></span>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
