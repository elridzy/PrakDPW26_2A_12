<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fungsi untuk mengecek status login pengguna (Guard)
function cekLogin() {
    if (!isset($_SESSION['user_id'])) {
        $path = isset($base) ? $base : '';
        header('Location: ' . $path . 'auth/login.php');
        exit;
    }
}
?>