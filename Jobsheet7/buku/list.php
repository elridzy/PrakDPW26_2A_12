<?php
session_start();
$page_title = "Daftar Buku";
$base = "../";
include '../includes/header.php';

if (!isset($_SESSION['buku'])) {
    $_SESSION['buku'] = [];
}
?>

<h2>Daftar Buku</h2>
<a href="tambah.php" class="btn">+ Tambah Buku Baru</a>

<!-- Flash Message -->
<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert success"><?= $_SESSION['flash']; unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($_SESSION['buku'])): ?>
            <tr><td colspan="5">Belum ada data buku.</td></tr>
        <?php else: ?>
            <?php foreach ($_SESSION['buku'] as $index => $buku): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($buku['judul']); ?></td>
                    <td><?= htmlspecialchars($buku['pengarang']); ?></td>
                    <td><?= htmlspecialchars($buku['tahun']); ?></td>
                    <td><?= htmlspecialchars($buku['stok']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>