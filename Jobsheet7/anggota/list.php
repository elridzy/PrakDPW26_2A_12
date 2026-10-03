<?php
session_start();
$page_title = "Daftar Anggota";
$base = "../";
include '../includes/header.php';

// Inisialisasi session anggota jika belum ada
if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}
?>

<h2>Daftar Anggota</h2>
<a href="tambah.php" class="btn">+ Tambah Anggota Baru</a>

<!-- Flash Message -->
<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert success"><?= $_SESSION['flash']; unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>NIM / ID</th>
            <th>Email</th>
            <th>No Telepon</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($_SESSION['anggota'])): ?>
            <tr><td colspan="5">Belum ada data anggota.</td></tr>
        <?php else: ?>
            <?php foreach ($_SESSION['anggota'] as $index => $anggota): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($anggota['nama']); ?></td>
                    <td><?= htmlspecialchars($anggota['nim']); ?></td>
                    <td><?= htmlspecialchars($anggota['email']); ?></td>
                    <td><?= htmlspecialchars($anggota['telepon']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>