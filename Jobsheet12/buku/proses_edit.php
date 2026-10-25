<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify();

    $id = $_POST['id'] ?? null;
    $judul = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun = $_POST['tahun'] ?? 0;
    $stok = $_POST['stok'] ?? 0;

    if ($id && !empty($judul)) {
        try {
            $stmt = $pdo->prepare("UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun, stok = :stok WHERE id = :id");
            $stmt->execute([
                'judul' => $judul,
                'pengarang' => $pengarang,
                'tahun' => $tahun,
                'stok' => $stok,
                'id' => $id
            ]);

            $_SESSION['flash'] = "Data buku berhasil diperbarui!";
        } catch (PDOException $e) {
            $_SESSION['flash'] = "Gagal memperbarui: " . $e->getMessage();
        }
    }
    header('Location: list.php');
    exit;
}