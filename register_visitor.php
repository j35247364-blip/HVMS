<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
$page_title = 'Register Visitor';
$error = ''; $success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $purpose   = trim($_POST['purpose'] ?? '');
    $host_name = trim($_POST['host_name'] ?? '');
    $room      = trim($_POST['room_number'] ?? '');
    $duration  = trim($_POST['expected_duration'] ?? '');
    $check_in_now = isset($_POST['check_in_now']);

    if ($full_name === '' || $purpose === '' || $host_name === '') {
        $error = 'Please fill in the visitor name, purpose, and host.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO visitors
            (full_name, phone, purpose, host_name, room_number, expected_duration, check_in_time, status, registered_by)
            VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->execute([
            $full_name, $phone, $purpose, $host_name, $room, $duration,
            $check_in_now ? date('Y-m-d H:i:s') : null,
            $check_in_now ? 'Checked In' : 'Pending',
            current_user()['id']
        ]);
        $success = 'Visitor "' . htmlspecialchars($full_name) . '" has been registered.';
    }
}

include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Front Desk</span>
    <h1>Register a New Visitor</h1>
    <p>Capture visitor details to keep an accurate, searchable record.</p>
  </div>
</div>

<?php if ($error): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>
<?php if ($success): ?><div class="alert alert-success"><?= $success ?> — <a href="register_visitor.php">Register another</a> or <a href="visitors.php">view all records</a>.</div><?php endif; ?>

<div class="card">
  <form method="POST" action="register_visitor.php">
    <div class="form-grid">
      <div class="form-group">
        <label for="full_name">Visitor Full Name *</label>
        <input type="text" id="full_name" name="full_name" required placeholder="e.g. Maria Lopez">
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" placeholder="+65 9123 4567">
      </div>
      <div class="form-group">
        <label for="purpose">Purpose of Visit *</label>
        <input type="text" id="purpose" name="purpose" required placeholder="e.g. Family visit, Delivery, Meeting">
      </div>
      <div class="form-group">
        <label for="host_name">Host (Guest / Staff being visited) *</label>
        <input type="text" id="host_name" name="host_name" required placeholder="e.g. Mr. J. Tan / Front Desk">
      </div>
      <div class="form-group">
        <label for="room_number">Room Number (if applicable)</label>
        <input type="text" id="room_number" name="room_number" placeholder="e.g. 512">
      </div>
      <div class="form-group">
        <label for="expected_duration">Expected Duration</label>
        <input type="text" id="expected_duration" name="expected_duration" placeholder="e.g. 2 hours, Overnight">
      </div>
    </div>

    <div class="form-group" style="display:flex; align-items:center; gap:8px;">
      <input type="checkbox" id="check_in_now" name="check_in_now" style="width:auto;">
      <label for="check_in_now" style="margin:0;">Check in immediately upon registration</label>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save Visitor Record</button>
      <a href="dashboard.php" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
