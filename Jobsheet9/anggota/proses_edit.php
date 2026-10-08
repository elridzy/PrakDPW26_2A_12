<?php
session_start();
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = $_POST['id'];
    $nama       = trim($_POST['nama'] ?? '');
    $no_anggota = trim($_POST['no_anggota'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $no_hp      = trim($_POST['no_hp'] ?? '');

    try {
        $stmt = $pdo->prepare("UPDATE anggota SET nama = :nama, no_anggota = :no_anggota, alamat = :alamat, no_hp = :no_hp WHERE id = :id");
        
        $stmt->execute([
            'nama'       => $nama,
            'no_anggota' => $no_anggota,
            'alamat'     => $alamat,
            'no_hp'      => $no_hp,
            'id'         => $id
        ]);

        $_SESSION['flash'] = "Data anggota berhasil diperbarui!";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Gagal memperbarui data: " . $e->getMessage();
    }

    header('Location: list.php');
    exit;
}