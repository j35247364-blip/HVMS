<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
$page_title = 'Help';
include __DIR__ . '/includes/header.php';
?>

<div class="page-head">
  <div>
    <span class="eyebrow">Support</span>
    <h1>Help &amp; Guidance</h1>
    <p>Quick answers for staff of all experience levels.</p>
  </div>
</div>

<div class="card">
  <div class="help-item">
    <h3>How do I register a visitor?</h3>
    <p>Go to <strong>Register Visitor</strong> in the sidebar. Fill in the visitor's name, purpose, and host, then save. Tick "Check in immediately" if they're entering the premises right away.</p>
  </div>
  <div class="help-item">
    <h3>How do I check a visitor in or out?</h3>
    <p>Open <strong>View / Search</strong>, find the visitor, and use the <em>Check In</em> or <em>Check Out</em> button in the Actions column. This records the exact time automatically.</p>
  </div>
  <div class="help-item">
    <h3>How do I search for a specific record?</h3>
    <p>On the <strong>View / Search</strong> page, type into the search box to filter instantly by name, purpose, or host. Use the status and date filters for more precise results.</p>
  </div>
  <div class="help-item">
    <h3>How do I correct a mistake in a record?</h3>
    <p>Click <strong>Edit</strong> next to any visitor record to update their details or status. Click <strong>Delete</strong> to remove a record entirely (this cannot be undone).</p>
  </div>
  <div class="help-item">
    <h3>How do I generate a report for management?</h3>
    <p>Go to <strong>Reports</strong>, choose a date range, and click <em>Generate Report</em>. Use <em>Print / Export PDF</em> to save a copy.</p>
  </div>
  <div class="help-item">
    <h3>What happens when a guest books a room online?</h3>
    <p>Guests can book directly from the public website without logging in. Their request appears under <strong>Online Bookings</strong>. Click <em>Confirm</em> to approve it — this automatically adds the guest to the visitor log as a pending arrival, or <em>Cancel</em> to decline it.</p>
  </div>
  <div class="help-item">
    <h3>I'm an administrator — how do I add staff accounts?</h3>
    <p>Open <strong>Admin Panel</strong> (visible to admins only), fill in the new staff member's details, and assign them the Staff or Admin role.</p>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
