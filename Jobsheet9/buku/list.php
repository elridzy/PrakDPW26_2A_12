<?php
session_start();
// Panggil koneksi database PDO
require_once '../includes/koneksi.php';

$page_title = "Daftar Buku";
$base = "../";
include '../includes/header.php';

// Ambil data buku langsung dari database PostgreSQL
try {
    $stmt = $pdo->query("SELECT * FROM buku ORDER BY id ASC");
    $daftar_buku = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $daftar_buku = [];
    $error_db = "Gagal memuat data: " . $e->getMessage();
}
?>

<h2>Daftar Buku</h2>
<a href="tambah.php" class="btn">+ Tambah Buku Baru</a>

<!-- Flash Message -->
<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert success"><?= $_SESSION['flash']; unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<?php if (isset($error_db)): ?>
    <div class="alert error"><?= $error_db; ?></div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($daftar_buku)): ?>
            <tr><td colspan="6">Belum ada data buku.</td></tr>
        <?php else: ?>
            <?php foreach ($daftar_buku as $index => $buku): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($buku['judul']); ?></td>
                    <td><?= htmlspecialchars($buku['pengarang']); ?></td>
                    <td><?= htmlspecialchars($buku['tahun']); ?></td>
                    <td><?= htmlspecialchars($buku['stok']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $buku['id']; ?>" class="btn-edit">Edit</a>
                        <form action="hapus.php" method="POST" style="display:inline;" class="form-hapus">
                            <input type="hidden" name="id" value="<?= $buku['id']; ?>">
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>