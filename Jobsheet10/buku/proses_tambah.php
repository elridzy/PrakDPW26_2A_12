<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun = $_POST['tahun'] ?? 0;
    $stok = $_POST['stok'] ?? 0;

    if (!empty($judul) && !empty($pengarang)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO buku (judul, pengarang, tahun, stok) VALUES (:judul, :pengarang, :tahun, :stok)");
            $stmt->execute([
                'judul' => $judul,
                'pengarang' => $pengarang,
                'tahun' => $tahun,
                'stok' => $stok
            ]);

            $_SESSION['flash'] = "Data buku berhasil ditambahkan!";
        } catch (PDOException $e) {
            $_SESSION['flash'] = "Gagal menyimpan: " . $e->getMessage();
        }
    }
    header('Location: list.php');
    exit;
}