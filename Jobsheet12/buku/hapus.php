<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM buku WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $_SESSION['flash'] = "Data buku berhasil dihapus!";
    } catch (PDOException $e) {
        if ($e->getCode() == '23503') {
            $_SESSION['flash'] = "Gagal dihapus: Buku ini tidak dapat dihapus karena masih tercatat dalam riwayat peminjaman.";
        }
    }
}
header('Location: list.php');
exit;