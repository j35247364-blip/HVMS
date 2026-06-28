<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
$page_title = 'Online Bookings';

// Confirm a booking -> creates a linked, pending visitor record for their future check-in
if (isset($_GET['action'], $_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($_GET['action'] === 'confirm') {
        $stmt = $pdo->prepare("SELECT * FROM bookings WHERE booking_id = ?");
        $stmt->execute([$id]);
        $b = $stmt->fetch();

        if ($b && $b['status'] === 'Pending') {
            $visitorStmt = $pdo->prepare("INSERT INTO visitors
                (full_name, phone, purpose, host_name, room_number, expected_duration, status, registered_by)
                VALUES (?,?,?,?,?,?, 'Pending', ?)");
            $visitorStmt->execute([
                $b['guest_name'], $b['phone'], 'Hotel Guest (Online Booking)', $b['room_type'], '-',
                date('d M', strtotime($b['check_in_date'])) . ' – ' . date('d M', strtotime($b['check_out_date'])),
                current_user()['id']
            ]);
            $visitorId = $pdo->lastInsertId();
            $pdo->prepare("UPDATE bookings SET status='Confirmed', linked_visitor_id=? WHERE booking_id=?")
                ->execute([$visitorId, $id]);
        }
    } elseif ($_GET['action'] === 'cancel') {
        $pdo->prepare("UPDATE bookings SET status='Cancelled' WHERE booking_id=?")->execute([$id]);
    }
    header('Location: bookings.php');
    exit;
}

$bookings = $pdo->query("SELECT * FROM bookings ORDER BY created_at DESC")->fetchAll();
include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Online Reservations</span>
    <h1>Booking Requests</h1>
    <p>Guests submit these from the public website. Confirming a booking adds the guest to the visitor log ahead of their stay.</p>
  </div>
  <a href="book_room.php" target="_blank" class="btn btn-ghost">View Public Booking Page ↗</a>
</div>

<div class="card">
  <table>
    <thead>
      <tr><th>Guest</th><th>Contact</th><th>Room</th><th>Check-in</th><th>Check-out</th><th>Guests</th><th>Status</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php if (!$bookings): ?>
        <tr><td colspan="8" style="text-align:center; color:var(--muted); padding:24px;">No booking requests yet.</td></tr>
      <?php endif; ?>
      <?php foreach ($bookings as $b): $cls = strtolower($b['status']); ?>
      <tr>
        <td><strong><?= htmlspecialchars($b['guest_name']) ?></strong></td>
        <td><?= htmlspecialchars($b['phone']) ?><br><span style="color:var(--muted); font-size:12px;"><?= htmlspecialchars($b['email']) ?></span></td>
        <td><?= htmlspecialchars($b['room_type']) ?></td>
        <td><?= date('d M Y', strtotime($b['check_in_date'])) ?></td>
        <td><?= date('d M Y', strtotime($b['check_out_date'])) ?></td>
        <td><?= (int) $b['guests'] ?></td>
        <td><span class="badge <?= $cls==='confirmed'?'checkedout':($cls==='cancelled'?'pending':'pending') ?>"><?= htmlspecialchars($b['status']) ?></span></td>
        <td class="row-actions">
          <?php if ($b['status'] === 'Pending'): ?>
            <a href="bookings.php?action=confirm&id=<?= $b['booking_id'] ?>" class="checkin">Confirm</a>
            <a href="bookings.php?action=cancel&id=<?= $b['booking_id'] ?>" class="delete confirm-delete">Cancel</a>
          <?php elseif ($b['status'] === 'Confirmed'): ?>
            <span style="font-size:12px; color:var(--muted);">Added to visitor log ✓</span>
          <?php else: ?>
            <span style="font-size:12px; color:var(--muted);">—</span>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
