<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
$page_title = 'Edit Visitor';

$id = (int) ($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM visitors WHERE visitor_id = ?");
$stmt->execute([$id]);
$v = $stmt->fetch();

if (!$v) { header('Location: visitors.php'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $purpose   = trim($_POST['purpose'] ?? '');
    $host_name = trim($_POST['host_name'] ?? '');
    $room      = trim($_POST['room_number'] ?? '');
    $duration  = trim($_POST['expected_duration'] ?? '');
    $status    = $_POST['status'] ?? $v['status'];

    if ($full_name === '' || $purpose === '' || $host_name === '') {
        $error = 'Visitor name, purpose, and host are required.';
    } else {
        $pdo->prepare("UPDATE visitors SET full_name=?, phone=?, purpose=?, host_name=?, room_number=?, expected_duration=?, status=? WHERE visitor_id=?")
            ->execute([$full_name, $phone, $purpose, $host_name, $room, $duration, $status, $id]);
        header('Location: visitors.php');
        exit;
    }
}

include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Edit Record</span>
    <h1>Update Visitor Details</h1>
    <p>Make corrections or update the status of this visitor record.</p>
  </div>
</div>

<?php if ($error): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>

<div class="card">
  <form method="POST" action="edit_visitor.php?id=<?= $v['visitor_id'] ?>">
    <div class="form-grid">
      <div class="form-group">
        <label>Visitor Full Name *</label>
        <input type="text" name="full_name" required value="<?= htmlspecialchars($v['full_name']) ?>">
      </div>
      <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($v['phone']) ?>">
      </div>
      <div class="form-group">
        <label>Purpose of Visit *</label>
        <input type="text" name="purpose" required value="<?= htmlspecialchars($v['purpose']) ?>">
      </div>
      <div class="form-group">
        <label>Host (Guest / Staff) *</label>
        <input type="text" name="host_name" required value="<?= htmlspecialchars($v['host_name']) ?>">
      </div>
      <div class="form-group">
        <label>Room Number</label>
        <input type="text" name="room_number" value="<?= htmlspecialchars($v['room_number']) ?>">
      </div>
      <div class="form-group">
        <label>Expected Duration</label>
        <input type="text" name="expected_duration" value="<?= htmlspecialchars($v['expected_duration']) ?>">
      </div>
      <div class="form-group">
        <label>Status</label>
        <select name="status">
          <option value="Pending" <?= $v['status']==='Pending'?'selected':'' ?>>Pending</option>
          <option value="Checked In" <?= $v['status']==='Checked In'?'selected':'' ?>>Checked In</option>
          <option value="Checked Out" <?= $v['status']==='Checked Out'?'selected':'' ?>>Checked Out</option>
        </select>
      </div>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Changes</button>
      <a href="visitors.php" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
