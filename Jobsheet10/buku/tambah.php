<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
$page_title = "Tambah Buku";
$base = "../";
include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Form Tambah Buku</h2>
    <form action="proses_tambah.php" method="POST">
        <div class="form-group">
            <label>Judul Buku:</label>
            <input type="text" name="judul" required>
        </div>
        <div class="form-group">
            <label>Pengarang:</label>
            <input type="text" name="pengarang" required>
        </div>
        <div class="form-group">
            <label>Tahun Terbit:</label>
            <input type="number" name="tahun" required>
        </div>
        <div class="form-group">
            <label>Stok:</label>
            <input type="number" name="stok" required>
        </div>
        <button type="submit">Simpan Buku</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>