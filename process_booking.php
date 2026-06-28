<?php
require_once __DIR__ . '/includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: book_room.php');
    exit;
}

$guest_name = trim($_POST['guest_name'] ?? '');
$email      = trim($_POST['email'] ?? '');
$phone      = trim($_POST['phone'] ?? '');
$room_type  = trim($_POST['room_type'] ?? '');
$check_in   = $_POST['check_in_date'] ?? '';
$check_out  = $_POST['check_out_date'] ?? '';
$guests     = (int) ($_POST['guests'] ?? 1);
$requests   = trim($_POST['special_requests'] ?? '');

$valid = $guest_name && $email && $phone && $room_type && $check_in && $check_out
    && filter_var($email, FILTER_VALIDATE_EMAIL)
    && strtotime($check_out) > strtotime($check_in)
    && $guests >= 1;

if (!$valid) {
    header('Location: book_room.php?error=1#book');
    exit;
}

$stmt = $pdo->prepare("INSERT INTO bookings
    (guest_name, email, phone, room_type, check_in_date, check_out_date, guests, special_requests, status)
    VALUES (?,?,?,?,?,?,?,?, 'Pending')");
$stmt->execute([$guest_name, $email, $phone, $room_type, $check_in, $check_out, $guests, $requests]);

header('Location: book_room.php?success=1#book');
exit;
