<?php
session_start();
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama       = trim($_POST['nama'] ?? '');
    $no_anggota = trim($_POST['no_anggota'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $no_hp      = trim($_POST['no_hp'] ?? '');

    if (!empty($nama) && !empty($no_anggota)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO anggota (nama, no_anggota, alamat, no_hp) VALUES (:nama, :no_anggota, :alamat, :no_hp)");
            $stmt->execute([
                'nama'       => $nama,
                'no_anggota' => $no_anggota,
                'alamat'     => $alamat,
                'no_hp'      => $no_hp
            ]);

            $_SESSION['flash'] = "Data anggota berhasil ditambahkan!";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Gagal menyimpan data: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Nama dan No Anggota wajib diisi!";
    }

    header('Location: list.php');
    exit;
}