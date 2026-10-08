<?php
session_start();
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($nama) && !empty($username) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, 'petugas')");
            $stmt->execute([
                'nama' => $nama,
                'username' => $username,
                'password' => $hashedPassword
            ]);

            $_SESSION['flash'] = "Registrasi berhasil! Silakan login.";
            header('Location: login.php');
            exit;
        } catch (PDOException $e) {
            $_SESSION['error'] = "Gagal registrasi (Username mungkin sudah terdaftar): " . $e->getMessage();
            header('Location: register.php');
            exit;
        }
    } else {
        $_SESSION['error'] = "Semua kolom wajib diisi!";
        header('Location: register.php');
        exit;
    }
}