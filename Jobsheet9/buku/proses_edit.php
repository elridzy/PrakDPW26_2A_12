<?php
require_once __DIR__ . '/../includes/koneksi.php';

// Memastikan data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangkap data dari form edit
    $id        = $_POST['id'];
    $judul     = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $tahun     = $_POST['tahun'];
    $isbn      = $_POST['isbn'];
    $stok      = $_POST['stok'];
    $kategori  = $_POST['kategori'];

    // Menjalankan query UPDATE dengan prepared statement untuk keamanan dari SQL Injection
    $stmt = $pdo->prepare("UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun, isbn = :isbn, stok = :stok, kategori = :kategori WHERE id = :id");
    
    $stmt->execute([
        'judul'     => $judul,
        'pengarang' => $pengarang,
        'tahun'     => $tahun,
        'isbn'      => $isbn,
        'stok'      => $stok,
        'kategori'  => $kategori,
        'id'        => $id
    ]);

    // Setelah berhasil memperbarui, arahkan kembali ke halaman daftar buku
    header('Location: list.php');
    exit;
}