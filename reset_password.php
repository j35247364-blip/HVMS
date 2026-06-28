<?php
/**
 * One-time helper: run this once in a browser (or CLI) if the seeded
 * admin password hash in database.sql doesn't work on your PHP build.
 * It resets the "admin" account password to admin123.
 *
 * DELETE THIS FILE after running it once — it should never stay on a live server.
 */
require_once __DIR__ . '/includes/config.php';

$newHash = password_hash('admin123', PASSWORD_DEFAULT);
$pdo->prepare("UPDATE users SET password_hash = ? WHERE username = 'admin'")->execute([$newHash]);

$uocHash = password_hash('uoc', PASSWORD_DEFAULT);
$pdo->prepare("UPDATE users SET password_hash = ? WHERE username = 'uoc'")->execute([$uocHash]);

echo "Admin password has been reset to: admin123\n";
echo "Default ordinary user 'uoc' password has been reset to: uoc\n";
echo "Please delete reset_password.php now.\n";
