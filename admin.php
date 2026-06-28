<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();
$page_title = 'Admin';

$userCount    = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$visitorCount = $pdo->query("SELECT COUNT(*) FROM visitors")->fetchColumn();

include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Administration</span>
    <h1>Admin Page</h1>
    <p>Links to every administrative task available to your role.</p>
  </div>
</div>

<div class="stats-row">
  <div class="stat-card"><div class="num"><?= $userCount ?></div><div class="label">Staff &amp; Admin Accounts</div></div>
  <div class="stat-card"><div class="num"><?= $visitorCount ?></div><div class="label">Total Visitor Records</div></div>
</div>

<div class="card">
  <h2>User Account Management</h2>
  <table>
    <thead><tr><th>Task</th><th>Description</th><th></th></tr></thead>
    <tbody>
      <tr>
        <td>Add User</td>
        <td>Create a new staff or admin account.</td>
        <td><a href="admin_users.php" class="btn btn-secondary">Open</a></td>
      </tr>
      <tr>
        <td>Select / View Users</td>
        <td>See every account, its role, and when it was created.</td>
        <td><a href="admin_users.php" class="btn btn-secondary">Open</a></td>
      </tr>
      <tr>
        <td>Edit User Role</td>
        <td>Manage account by deleting and re-adding with a corrected role.</td>
        <td><a href="admin_users.php" class="btn btn-secondary">Open</a></td>
      </tr>
      <tr>
        <td>Delete User</td>
        <td>Remove a staff or admin account from the system.</td>
        <td><a href="admin_users.php" class="btn btn-secondary">Open</a></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="card">
  <h2>Visitor Data &amp; Reporting</h2>
  <table>
    <thead><tr><th>Task</th><th>Description</th><th></th></tr></thead>
    <tbody>
      <tr>
        <td>View / Search Visitor Records</td>
        <td>Browse, edit, check in/out, or delete any visitor record.</td>
        <td><a href="visitors.php" class="btn btn-secondary">Open</a></td>
      </tr>
      <tr>
        <td>Generate Reports</td>
        <td>Date-range visitor activity summary with purpose breakdown.</td>
        <td><a href="reports.php" class="btn btn-secondary">Open</a></td>
      </tr>
      <tr>
        <td>Functionalities Overview</td>
        <td>Full list of facilities available in the system.</td>
        <td><a href="functionalities.php" class="btn btn-secondary">Open</a></td>
      </tr>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
