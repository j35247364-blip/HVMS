<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
$page_title = 'Reports';

$from = $_GET['from'] ?? date('Y-m-d', strtotime('-7 days'));
$to   = $_GET['to']   ?? date('Y-m-d');

$stmt = $pdo->prepare("SELECT * FROM visitors WHERE DATE(created_at) BETWEEN ? AND ? ORDER BY created_at DESC");
$stmt->execute([$from, $to]);
$rows = $stmt->fetchAll();

$total = count($rows);
$checkedOut = count(array_filter($rows, fn($r) => $r['status'] === 'Checked Out'));
$checkedIn  = count(array_filter($rows, fn($r) => $r['status'] === 'Checked In'));
$pending    = count(array_filter($rows, fn($r) => $r['status'] === 'Pending'));

// Group by purpose for a quick breakdown
$byPurpose = [];
foreach ($rows as $r) { $byPurpose[$r['purpose']] = ($byPurpose[$r['purpose']] ?? 0) + 1; }

include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Management Oversight</span>
    <h1>Visitor Activity Report</h1>
    <p>Generate a structured summary of visitor activity for any date range.</p>
  </div>
</div>

<div class="card">
  <form method="GET" class="search-bar">
    <label style="margin:0 6px 0 0; align-self:center;">From</label>
    <input type="date" name="from" value="<?= htmlspecialchars($from) ?>">
    <label style="margin:0 6px 0 0; align-self:center;">To</label>
    <input type="date" name="to" value="<?= htmlspecialchars($to) ?>">
    <button type="submit" class="btn btn-primary">Generate Report</button>
    <button type="button" class="btn btn-secondary" onclick="window.print()">Print / Export PDF</button>
  </form>
</div>

<div class="stats-row">
  <div class="stat-card"><div class="num"><?= $total ?></div><div class="label">Total Visitors</div></div>
  <div class="stat-card"><div class="num"><?= $checkedOut ?></div><div class="label">Completed Visits</div></div>
  <div class="stat-card"><div class="num"><?= $checkedIn ?></div><div class="label">Still On-site</div></div>
  <div class="stat-card coral"><div class="num"><?= $pending ?></div><div class="label">Never Checked In</div></div>
</div>

<div class="card">
  <h2>Breakdown by Purpose</h2>
  <table>
    <thead><tr><th>Purpose</th><th>Count</th></tr></thead>
    <tbody>
      <?php if (!$byPurpose): ?><tr><td colspan="2" style="text-align:center;color:var(--muted);">No data for this range.</td></tr><?php endif; ?>
      <?php foreach ($byPurpose as $purpose => $count): ?>
        <tr><td><?= htmlspecialchars($purpose) ?></td><td><?= $count ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="card">
  <h2>Detailed Log (<?= htmlspecialchars($from) ?> to <?= htmlspecialchars($to) ?>)</h2>
  <table>
    <thead><tr><th>Visitor</th><th>Purpose</th><th>Host</th><th>Check-in</th><th>Check-out</th><th>Status</th></tr></thead>
    <tbody>
      <?php foreach ($rows as $v): $cls = strtolower(str_replace(' ', '', $v['status'])); ?>
      <tr>
        <td><?= htmlspecialchars($v['full_name']) ?></td>
        <td><?= htmlspecialchars($v['purpose']) ?></td>
        <td><?= htmlspecialchars($v['host_name']) ?></td>
        <td><?= $v['check_in_time'] ? date('d M, H:i', strtotime($v['check_in_time'])) : '—' ?></td>
        <td><?= $v['check_out_time'] ? date('d M, H:i', strtotime($v['check_out_time'])) : '—' ?></td>
        <td><span class="badge <?= $cls ?>"><?= htmlspecialchars($v['status']) ?></span></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
