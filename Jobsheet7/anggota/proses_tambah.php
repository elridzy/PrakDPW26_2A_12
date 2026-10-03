<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $nim = trim($_POST['nim']);
    $email = trim($_POST['email']);
    $telepon = trim($_POST['telepon']);

    // Validasi sederhana di server
    if (!empty($nama) && !empty($nim) && !empty($email) && !empty($telepon)) {
        // Simpan ke array session anggota
        $_SESSION['anggota'][] = [
            'nama' => $nama,
            'nim' => $nim,
            'email' => $email,
            'telepon' => $telepon
        ];

        // Set flash message sukses
        $_SESSION['flash'] = "Data anggota berhasil ditambahkan!";
    } else {
        $_SESSION['flash'] = "Gagal! Semua kolom wajib diisi.";
    }

    // Redirect kembali ke halaman list anggota
    header('Location: list.php');
    exit;
}