<?php
session_start();
$page_title = "Daftar Anggota";
$base = "../";
include '../includes/header.php';
// Memasukkan file koneksi database PostgreSQL
include '../includes/koneksi.php';

// Mengambil data anggota langsung dari database PostgreSQL
try {
    $stmt = $pdo->query("SELECT * FROM anggota ORDER BY id ASC");
    $anggota_list = $stmt->fetchAll();
} catch (PDOException $e) {
    $anggota_list = [];
    $error_message = $e->getMessage();
}
?>

<h2>Daftar Anggota</h2>
<a href="tambah.php" class="btn">+ Tambah Anggota Baru</a>

<!-- Flash Message -->
<?php if (isset($_SESSION['flash'])): ?>
    <div class="alert success"><?= $_SESSION['flash']; unset($_SESSION['flash']); ?></div>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <div class="alert error">Gagal memuat data: <?= $error_message; ?></div>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>No Anggota / ID</th>
            <th>Alamat</th>
            <th>No Telepon</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($anggota_list)): ?>
            <tr><td colspan="5">Belum ada data anggota.</td></tr>
        <?php else: ?>
            <?php foreach ($anggota_list as $index => $anggota): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= htmlspecialchars($anggota['nama']); ?></td>
                    <td><?= htmlspecialchars($anggota['no_anggota']); ?></td>
                    <td><?= htmlspecialchars($anggota['alamat']); ?></td>
                    <td><?= htmlspecialchars($anggota['no_hp']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>