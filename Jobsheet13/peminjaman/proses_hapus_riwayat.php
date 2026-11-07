<?php
session_start();
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$id) {
        $_SESSION['error'] = "ID riwayat tidak valid.";
        header('Location: riwayat.php');
        exit;
    }

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("DELETE FROM peminjaman WHERE id = ?");
        $stmt->execute([$id]);

        $pdo->commit();

        $_SESSION['flash'] = "Riwayat peminjaman berhasil dihapus.";
        header('Location: riwayat.php');
        exit;

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $_SESSION['error'] = "Gagal menghapus riwayat: " . $e->getMessage();
        header('Location: riwayat.php');
        exit;
    }
} else {
    header('Location: riwayat.php');
    exit;
}