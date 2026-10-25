<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $_SESSION['flash'] = "Data anggota berhasil dihapus!";
    } catch (PDOException $e) {
        $_SESSION['flash'] = "Gagal menghapus: " . $e->getMessage();
    }
}
header('Location: list.php');
exit;