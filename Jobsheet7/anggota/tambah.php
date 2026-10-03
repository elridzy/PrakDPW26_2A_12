<?php
session_start();
$page_title = "Tambah Anggota";
$base = "../";
include '../includes/header.php';
?>

<h2>Form Tambah Anggota</h2>
<form action="proses_tambah.php" method="POST">
    <div class="form-group">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" required>
    </div>
    <div class="form-group">
        <label>NIM / ID:</label>
        <input type="text" name="nim" required>
    </div>
    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    <div class="form-group">
        <label>No Telepon:</label>
        <input type="text" name="telepon" required>
    </div>
    <button type="submit" class="btn">Simpan Anggota</button>
</form>

<?php include '../includes/footer.php'; ?>