<?php
require_once __DIR__ . '/includes/auth.php';
require_admin();
$page_title = 'Admin Panel';
$error = ''; $success = '';

// Add new user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $full_name = trim($_POST['full_name'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $password  = $_POST['password'] ?? '';
    $role      = $_POST['role'] ?? 'staff';

    if ($full_name === '' || $username === '' || $password === '') {
        $error = 'All fields are required to add a user.';
    } else {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO users (full_name, username, password_hash, role) VALUES (?,?,?,?)")
                ->execute([$full_name, $username, $hash, $role]);
            $success = 'User "' . htmlspecialchars($username) . '" created.';
        } catch (PDOException $e) {
            $error = 'That username is already taken.';
        }
    }
}

// Delete user
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    if ($id !== (int) current_user()['id']) { // can't delete yourself
        $pdo->prepare("DELETE FROM users WHERE user_id=?")->execute([$id]);
    }
    header('Location: admin_users.php');
    exit;
}

$users = $pdo->query("SELECT * FROM users ORDER BY created_at DESC")->fetchAll();
include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Administration</span>
    <h1>Manage Staff Accounts</h1>
    <p>Add, review, or remove user accounts and assign access roles.</p>
  </div>
  <a href="admin.php" class="btn btn-ghost">← Back to Admin Page</a>
</div>

<?php if ($error): ?><div class="alert alert-error"><?= $error ?></div><?php endif; ?>
<?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

<div class="card">
  <h2>Add New User</h2>
  <form method="POST" action="admin_users.php">
    <div class="form-grid">
      <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="full_name" required>
      </div>
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" required>
      </div>
      <div class="form-group">
        <label>Role</label>
        <select name="role">
          <option value="staff">Staff</option>
          <option value="admin">Admin</option>
        </select>
      </div>
    </div>
    <button type="submit" name="add_user" class="btn btn-primary">Create User</button>
  </form>
</div>

<div class="card">
  <h2>Existing Users</h2>
  <table>
    <thead><tr><th>Name</th><th>Username</th><th>Role</th><th>Created</th><th>Actions</th></tr></thead>
    <tbody>
      <?php foreach ($users as $u): ?>
      <tr>
        <td><?= htmlspecialchars($u['full_name']) ?></td>
        <td><?= htmlspecialchars($u['username']) ?></td>
        <td><span class="badge <?= $u['role']==='admin'?'checkedin':'pending' ?>"><?= htmlspecialchars(ucfirst($u['role'])) ?></span></td>
        <td><?= date('d M Y', strtotime($u['created_at'])) ?></td>
        <td class="row-actions">
          <?php if ((int)$u['user_id'] !== (int)current_user()['id']): ?>
            <a href="admin_users.php?delete=<?= $u['user_id'] ?>" class="delete confirm-delete">Delete</a>
          <?php else: ?>
            <span style="color:var(--muted); font-size:12px;">(you)</span>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
