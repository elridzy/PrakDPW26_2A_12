<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';

$page_title = "Daftar Anggota";
$base = "../";
include __DIR__ . '/../includes/header.php';

$stmt = $pdo->query("SELECT * FROM anggota ORDER BY id ASC");
$daftar_anggota = $stmt->fetchAll(PDO::FETCH_ASSOC);
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<section>
    <h2>Daftar Anggota</h2>
    <a href="tambah.php">+ Tambah Anggota</a>

    <?php if ($flash): ?>
        <?php 
            $is_error = (strpos($flash, 'Gagal') !== false || strpos($flash, 'kesalahan') !== false);
            $text_color = $is_error ? '#dc3545' : 'green';
        ?>
        <p style="color: <?php echo $text_color; ?>; margin-top: 0.75rem; font-weight: 500;"><?php echo htmlspecialchars($flash); ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>No Anggota / ID</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($daftar_anggota) > 0): ?>
                <?php $no = 1; foreach ($daftar_anggota as $anggota): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($anggota['nama']); ?></td>
                    <td><?php echo htmlspecialchars($anggota['no_anggota']); ?></td>
                    <td><?php echo htmlspecialchars($anggota['alamat']); ?></td>
                    <td><?php echo htmlspecialchars($anggota['no_hp']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $anggota['id']; ?>" class="btn-edit">Edit</a>
                        <a href="hapus.php?id=<?php echo $anggota['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" style="text-align: center;">Belum ada data anggota.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>