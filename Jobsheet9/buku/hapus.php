<?php
session_start();
require_once __DIR__ . '/../includes/koneksi.php';

// Memastikan permintaan hapus hanya diproses jika menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        // Menjalankan query DELETE dengan prepared statement
        $stmt = $pdo->prepare("DELETE FROM buku WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}

// Redirect kembali ke halaman daftar buku setelah selesai
header('Location: list.php');
exit;