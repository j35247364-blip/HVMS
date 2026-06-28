<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
$page_title = 'Functionalities';
include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">System Overview</span>
    <h1>Functionalities</h1>
    <p>All facilities available in the Coral Cove Visitor Management System.</p>
  </div>
</div>

<div class="card">
  <h2>Available to all logged-in users</h2>
  <table>
    <thead><tr><th>Functionality</th><th>Description</th></tr></thead>
    <tbody>
      <tr><td>User Login / Logout</td><td>Secure session-based authentication; unauthorized visitors cannot view protected pages.</td></tr>
      <tr><td>Home Dashboard</td><td>Personalised overview of recent visitor activity and pending check-ins.</td></tr>
      <tr><td>Visitor Registration</td><td>Capture visitor name, contact, purpose, host, room, and expected duration.</td></tr>
      <tr><td>View &amp; Search Records</td><td>Browse the full visitor log; filter instantly by name, purpose, host, date, or status.</td></tr>
      <tr><td>Check-In / Check-Out</td><td>Record precise entry and exit times to track who is currently on the premises.</td></tr>
      <tr><td>Edit &amp; Delete Records</td><td>Correct visitor information or remove records as authorised by role.</td></tr>
      <tr><td>Visitor Reports</td><td>Generate activity summaries over a chosen date range, with a purpose breakdown and printable output.</td></tr>
      <tr><td>Help Page</td><td>Step-by-step guidance for staff of all experience levels.</td></tr>
      <tr><td>Online Booking Requests</td><td>Review room booking requests submitted by guests through the public website; confirming one adds the guest to the visitor log.</td></tr>
    </tbody>
  </table>
</div>

<div class="card">
  <h2>Public website (no login required)</h2>
  <table>
    <thead><tr><th>Functionality</th><th>Description</th></tr></thead>
    <tbody>
      <tr><td>Public Booking Page</td><td>Guests can browse room categories, amenities, and contact details, then submit a booking request — fully separate from the staff system.</td></tr>
    </tbody>
  </table>
</div>

<div class="card">
  <h2>Administrator-only functionalities</h2>
  <table>
    <thead><tr><th>Functionality</th><th>Description</th></tr></thead>
    <tbody>
      <tr><td>Admin Panel</td><td>Central hub linking to all administrative tasks below.</td></tr>
      <tr><td>Add User</td><td>Create new staff or administrator accounts with a username and password.</td></tr>
      <tr><td>Select / View Users</td><td>List every account in the system along with its role and creation date.</td></tr>
      <tr><td>Delete User</td><td>Remove a staff or admin account (an admin cannot delete their own account).</td></tr>
      <tr><td>Role Assignment</td><td>Assign each account the "Staff" (ordinary user) or "Admin" role.</td></tr>
    </tbody>
  </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
