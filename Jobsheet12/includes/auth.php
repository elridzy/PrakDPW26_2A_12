<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function cekLogin() {
    if (!isset($_SESSION['user_id'])) {
        $path = isset($base) ? $base : '';
        header('Location: ' . $path . 'auth/login.php');
        exit;
    }
}
?>