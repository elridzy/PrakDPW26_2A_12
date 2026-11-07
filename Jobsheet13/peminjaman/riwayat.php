<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/helpers.php';

$page_title = "Riwayat Peminjaman";
$base = "../";
include __DIR__ . '/../includes/header.php';

$stmt = $pdo->query("
    select peminjaman.id, anggota.nama as nama_anggota, buku.judul as judul_buku, peminjaman.tanggal_pinjam, peminjaman.tanggal_kembali, peminjaman.status 
    from peminjaman 
    join anggota on peminjaman.anggota_id = anggota.id 
    join buku on peminjaman.buku_id = buku.id 
    order by peminjaman.id desc
");
$daftar_riwayat = $stmt->fetchAll(PDO::FETCH_ASSOC);

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<section>
    <h2>Riwayat Peminjaman Buku</h2>

    <?php if ($flash): ?>
        <p style="color: green; margin-top: 0.75rem;"><?php echo e($flash); ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p style="color: red; margin-top: 0.75rem;"><?php echo e($error); ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 1rem;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($daftar_riwayat) > 0): ?>
                <?php $no = 1; foreach ($daftar_riwayat as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo e($row['nama_anggota']); ?></td>
                    <td><?php echo e($row['judul_buku']); ?></td>
                    <td><?php echo e($row['tanggal_pinjam']); ?></td>
                    <td><?php echo e($row['tanggal_kembali'] ?? '-'); ?></td>
                    <td><?php echo e(ucfirst($row['status'])); ?></td>
                    <td>
                        <form action="proses_hapus_riwayat.php" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus riwayat ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align: center;">Belum ada riwayat peminjaman.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>