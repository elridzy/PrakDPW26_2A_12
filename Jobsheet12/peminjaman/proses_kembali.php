<?php
session_start();
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $peminjaman_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if (!$peminjaman_id) {
        $_SESSION['error'] = "ID peminjaman tidak valid.";
        header('Location: kembali.php');
        exit;
    }

    try {
        $pdo->beginTransaction();

        $stmt_cek = $pdo->prepare("
            select buku_id, status 
            from peminjaman 
            where id = :id for update
        ");
        $stmt_cek->execute(['id' => $peminjaman_id]);
        $pinjam = $stmt_cek->fetch(PDO::FETCH_ASSOC);

        if (!$pinjam) {
            throw new Exception("Data peminjaman tidak ditemukan.");
        }

        if ($pinjam['status'] === 'selesai') {
            throw new Exception("Buku ini sudah dikembalikan sebelumnya.");
        }

        $buku_id = $pinjam['buku_id'];

        $stmt_update = $pdo->prepare("
            update peminjaman 
            set status = 'selesai', tanggal_kembali = current_date 
            where id = :id
        ");
        $stmt_update->execute(['id' => $peminjaman_id]);

        $stmt_stok = $pdo->prepare("
            update buku 
            set stok = stok + 1 
            where id = :buku_id
        ");
        $stmt_stok->execute(['buku_id' => $buku_id]);

        $pdo->commit();

        $_SESSION['flash'] = "Buku berhasil dikembalikan dan stok telah diperbarui.";
        header('Location: kembali.php');
        exit;

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $_SESSION['error'] = "Gagal memproses pengembalian: " . $e->getMessage();
        header('Location: kembali.php');
        exit;
    }
} else {
    header('Location: kembali.php');
    exit;
}