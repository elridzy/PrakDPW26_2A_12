<?php
session_start();
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi token CSRF untuk mencegah serangan Cross-Site Request Forgery
    csrf_verify();

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Mitigasi Session Fixation: Meregenerasi ID sesi setelah login berhasil
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];

            header('Location: ../index.php');
            exit;
        } else {
            $_SESSION['error'] = "Username atau password salah!";
            header('Location: login.php');
            exit;
        }
    } else {
        $_SESSION['error'] = "Semua kolom wajib diisi!";
        header('Location: login.php');
        exit;
    }
}