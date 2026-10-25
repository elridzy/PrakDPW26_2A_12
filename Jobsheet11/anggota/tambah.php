<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
$page_title = "Tambah Anggota";
$base = "../";
include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Form Tambah Anggota</h2>
    <form action="proses_tambah.php" method="POST">
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>No Anggota / ID:</label>
            <input type="text" name="no_anggota" required>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" required></textarea>
        </div>
        <div class="form-group">
            <label>No Telepon:</label>
            <input type="text" name="no_hp" required>
        </div>
        <button type="submit">Simpan Anggota</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>