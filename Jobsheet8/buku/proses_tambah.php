<?php
session_start();
// Panggil file koneksi database PDO
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun     = trim($_POST['tahun'] ?? '');
    $stok      = trim($_POST['stok'] ?? '');
    $isbn      = trim($_POST['isbn'] ?? '');

    // Validasi format ISBN sederhana jika diisi
    if (!empty($isbn) && !preg_match('/^[0-9-]+$/', $isbn)) {
        $_SESSION['error'] = "Format ISBN tidak valid! Hanya boleh berisi angka dan tanda hubung (-).";
        header("Location: tambah.php");
        exit;
    }

    // Validasi apakah kolom wajib terisi
    if (!empty($judul) && !empty($pengarang) && !empty($tahun) && !empty($stok)) {
        try {
            // Query SQL INSERT menggunakan Prepared Statement untuk mencegah SQL Injection
            $sql = "INSERT INTO buku (judul, pengarang, tahun, stok, isbn) VALUES (:judul, :pengarang, :tahun, :stok, :isbn)";
            $stmt = $pdo->prepare($sql);
            
            // Eksekusi query dengan data dari form
            $stmt->execute([
                ':judul'     => $judul,
                ':pengarang' => $pengarang,
                ':tahun'     => $tahun,
                ':stok'      => $stok,
                ':isbn'      => $isbn
            ]);

            $_SESSION['flash'] = "Data buku berhasil ditambahkan ke database!";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Gagal menyimpan ke database: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Gagal! Semua kolom wajib diisi.";
    }

    header('Location: list.php');
    exit;
}