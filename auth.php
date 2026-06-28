<?php
/**
 * Coral Cove HVMS — Authentication helpers
 */
require_once __DIR__ . '/config.php';

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function require_admin() {
    require_login();
    if ($_SESSION['role'] !== 'admin') {
        header('Location: dashboard.php?error=forbidden');
        exit;
    }
}

function current_user() {
    return [
        'id'   => $_SESSION['user_id']   ?? null,
        'name' => $_SESSION['full_name'] ?? '',
        'role' => $_SESSION['role']      ?? '',
    ];
}
