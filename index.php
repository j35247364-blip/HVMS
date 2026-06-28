<?php
require_once __DIR__ . '/includes/auth.php';

// If logged in, Home = personalised dashboard
if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

// If not logged in, show the default public Home page
$page_title = 'Home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coral Cove · Visitor Management System</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="login-wrap">
  <svg class="horizon" viewBox="0 0 1440 200" preserveAspectRatio="none">
    <path d="M0,120 C240,180 480,60 720,110 C960,160 1200,60 1440,100 L1440,200 L0,200 Z" fill="#0B2B3C" opacity="0.55"/>
    <path d="M0,150 C240,100 480,170 720,140 C960,110 1200,180 1440,150 L1440,200 L0,200 Z" fill="#15707A" opacity="0.65"/>
  </svg>

  <div class="login-card" style="text-align:center;">
    <span class="brand-wave">~</span>
    <h1>Coral Cove</h1>
    <p class="sub">Visitor Management · Ocean View Hotel</p>
    <p style="font-size:13px; color:var(--muted); line-height:1.6; margin-bottom:20px;">
      A secure, centralised platform for hotel staff to register, manage,
      and track visitor activity — replacing manual logbooks with a fast,
      searchable digital record.
    </p>
    <a href="login.php" class="btn btn-primary" style="width:100%; display:block;">Staff Login</a>
    <a href="book_room.php" class="btn btn-secondary" style="width:100%; display:block; margin-top:10px;">Book a Room Online</a>
    <p class="login-hint">Not logged in. Please sign in to access the staff system.</p>
  </div>
</div>
</body>
</html>

