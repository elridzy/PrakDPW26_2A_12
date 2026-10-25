<?php
session_start();
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $anggota_id = filter_input(INPUT_POST, 'anggota_id', FILTER_VALIDATE_INT);
    $buku_id = filter_input(INPUT_POST, 'buku_id', FILTER_VALIDATE_INT);

    if (!$anggota_id || !$buku_id) {
        $_SESSION['error'] = "Pilihan anggota atau buku tidak valid.";
        header('Location: tambah.php');
        exit;
    }

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("
            INSERT INTO peminjaman (anggota_id, buku_id, tanggal_pinjam, status) 
            VALUES (?, ?, CURRENT_DATE, 'dipinjam')
        ");
        $stmt->execute([$anggota_id, $buku_id]);

        $pdo->commit();

        $_SESSION['flash'] = "Data peminjaman berhasil ditambahkan.";
        header('Location: kembali.php');
        exit;

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $_SESSION['error'] = "Gagal memproses peminjaman: " . $e->getMessage();
        header('Location: tambah.php');
        exit;
    }
} else {
    header('Location: tambah.php');
    exit;
}