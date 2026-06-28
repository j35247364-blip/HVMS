<?php
/**
 * Coral Cove HVMS — Database Configuration
 * Update the values below to match your local MySQL/MariaDB setup.
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'coralcove_hvms');
define('DB_USER', 'root');
define('DB_PASS', '');          // set your MySQL password here

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Start session on every page that includes this file
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
