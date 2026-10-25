<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/helpers.php';

$page_title = "Tambah Peminjaman";
$base = "../";
include __DIR__ . '/../includes/header.php';

$stmtAnggota = $pdo->query("SELECT id, nama FROM anggota ORDER BY nama ASC");
$daftar_anggota = $stmtAnggota->fetchAll(PDO::FETCH_ASSOC);

$stmtBuku = $pdo->query("SELECT id, judul FROM buku ORDER BY judul ASC");
$daftar_buku = $stmtBuku->fetchAll(PDO::FETCH_ASSOC);

$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<section style="max-width: 600px; margin: 2rem auto;">
    <h2>Tambah Peminjaman Buku</h2>

    <?php if ($error): ?>
        <p style="color: red; margin-bottom: 1rem;"><?php echo e($error); ?></p>
    <?php endif; ?>

    <form action="proses_tambah.php" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="anggota_id">Pilih Anggota:</label>
            <select name="anggota_id" id="anggota_id" required>
                <option value="">Pilih Anggota</option>
                <?php foreach ($daftar_anggota as $anggota): ?>
                    <option value="<?php echo $anggota['id']; ?>"><?php echo e($anggota['nama']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="buku_id">Pilih Buku:</label>
            <select name="buku_id" id="buku_id" required>
                <option value="">Pilih Buku</option>
                <?php foreach ($daftar_buku as $buku): ?>
                    <option value="<?php echo $buku['id']; ?>"><?php echo e($buku['judul']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Simpan Peminjaman</button>
        <a href="kembali.php" class="btn" style="background-color: #6c757d; margin-left: 0.5rem; text-decoration: none;">Batal</a>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>