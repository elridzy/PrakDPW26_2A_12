<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $tahun = trim($_POST['tahun']);
    $stok = trim($_POST['stok']);

    if (!empty($judul) && !empty($pengarang) && !empty($tahun) && !empty($stok)) {
        $_SESSION['buku'][] = [
            'judul' => $judul,
            'pengarang' => $pengarang,
            'tahun' => $tahun,
            'stok' => $stok
        ];
        $_SESSION['flash'] = "Data buku berhasil ditambahkan!";
    } else {
        $_SESSION['flash'] = "Gagal! Semua kolom wajib diisi.";
    }

    header('Location: list.php');
    exit;
}