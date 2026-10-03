<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = trim($_POST['nama'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $telepon = trim($_POST['telepon'] ?? '');

    // Validasi nomor telepon: hanya angka dan panjang 10-13 digit
    if (!empty($telepon) && !preg_match('/^[0-9]{10,13}$/', $telepon)) {
        $_SESSION['error'] = "Nomor telepon harus berupa angka (10-13 digit)!";
        header("Location: tambah.php");
        exit;
    }

    if (!empty($nama) && !empty($email)) {
        if (!isset($_SESSION['anggota'])) {
            $_SESSION['anggota'] = [];
        }

        $_SESSION['anggota'][] = [
            'nama'    => $nama,
            'email'   => $email,
            'telepon' => $telepon
        ];
        $_SESSION['flash'] = "Data anggota berhasil ditambahkan!";
    } else {
        $_SESSION['flash'] = "Gagal! Nama dan Email wajib diisi.";
    }

    header('Location: list.php');
    exit;
}