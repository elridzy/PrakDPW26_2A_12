<?php
session_start();
require_once __DIR__ . '/../includes/koneksi.php';

// Memastikan permintaan hanya diproses jika menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Menjalankan query DELETE dengan prepared statement
        $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}

// Redirect kembali ke halaman daftar anggota setelah selesai
header('Location: list.php');
exit;