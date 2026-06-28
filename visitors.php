<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
$page_title = 'Visitor Records';

// Handle quick actions: check-in, check-out, delete
if (isset($_GET['action'], $_GET['id'])) {
    $id = (int) $_GET['id'];
    if ($_GET['action'] === 'checkin') {
        $pdo->prepare("UPDATE visitors SET status='Checked In', check_in_time=NOW() WHERE visitor_id=?")->execute([$id]);
    } elseif ($_GET['action'] === 'checkout') {
        $pdo->prepare("UPDATE visitors SET status='Checked Out', check_out_time=NOW() WHERE visitor_id=?")->execute([$id]);
    } elseif ($_GET['action'] === 'delete') {
        $pdo->prepare("DELETE FROM visitors WHERE visitor_id=?")->execute([$id]);
    }
    header('Location: visitors.php');
    exit;
}

// Server-side filtering (date / status) — name search is also done live in JS
$where = []; $params = [];
if (!empty($_GET['status'])) { $where[] = 'status = ?'; $params[] = $_GET['status']; }
if (!empty($_GET['date']))   { $where[] = 'DATE(created_at) = ?'; $params[] = $_GET['date']; }
$sql = "SELECT * FROM visitors";
if ($where) $sql .= " WHERE " . implode(' AND ', $where);
$sql .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$visitors = $stmt->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Visitor Log</span>
    <h1>View &amp; Search Records</h1>
    <p>Browse the full visitor log and filter by name, date, or status.</p>
  </div>
  <a href="register_visitor.php" class="btn btn-primary">＋ Register Visitor</a>
</div>

<div class="card">
  <form method="GET" class="search-bar">
    <input type="text" id="liveSearch" placeholder="Search by name, purpose, or host...">
    <select name="status" onchange="this.form.submit()">
      <option value="">All Statuses</option>
      <option value="Pending"     <?= ($_GET['status'] ?? '')==='Pending' ? 'selected':'' ?>>Pending</option>
      <option value="Checked In"  <?= ($_GET['status'] ?? '')==='Checked In' ? 'selected':'' ?>>Checked In</option>
      <option value="Checked Out" <?= ($_GET['status'] ?? '')==='Checked Out' ? 'selected':'' ?>>Checked Out</option>
    </select>
    <input type="date" name="date" value="<?= htmlspecialchars($_GET['date'] ?? '') ?>" onchange="this.form.submit()">
    <a href="visitors.php" class="btn btn-ghost">Clear Filters</a>
  </form>

  <table id="visitorsTable">
    <thead>
      <tr>
        <th>Visitor</th><th>Phone</th><th>Purpose</th><th>Host / Room</th>
        <th>Check-in</th><th>Check-out</th><th>Status</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!$visitors): ?>
        <tr><td colspan="8" style="text-align:center; color:var(--muted); padding:24px;">No matching records found.</td></tr>
      <?php endif; ?>
      <?php foreach ($visitors as $v): $cls = strtolower(str_replace(' ', '', $v['status'])); ?>
      <tr>
        <td><strong><?= htmlspecialchars($v['full_name']) ?></strong></td>
        <td><?= htmlspecialchars($v['phone'] ?: '—') ?></td>
        <td><?= htmlspecialchars($v['purpose']) ?></td>
        <td><?= htmlspecialchars($v['host_name']) ?> <?= $v['room_number'] ? '(' . htmlspecialchars($v['room_number']) . ')' : '' ?></td>
        <td><?= $v['check_in_time'] ? date('d M, H:i', strtotime($v['check_in_time'])) : '—' ?></td>
        <td><?= $v['check_out_time'] ? date('d M, H:i', strtotime($v['check_out_time'])) : '—' ?></td>
        <td><span class="badge <?= $cls ?>"><?= htmlspecialchars($v['status']) ?></span></td>
        <td class="row-actions">
          <?php if ($v['status'] === 'Pending'): ?>
            <a href="visitors.php?action=checkin&id=<?= $v['visitor_id'] ?>" class="checkin">Check In</a>
          <?php elseif ($v['status'] === 'Checked In'): ?>
            <a href="visitors.php?action=checkout&id=<?= $v['visitor_id'] ?>" class="checkout">Check Out</a>
          <?php endif; ?>
          <a href="edit_visitor.php?id=<?= $v['visitor_id'] ?>" class="edit">Edit</a>
          <a href="visitors.php?action=delete&id=<?= $v['visitor_id'] ?>" class="delete confirm-delete">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
