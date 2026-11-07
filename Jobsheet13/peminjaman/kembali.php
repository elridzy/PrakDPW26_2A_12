<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/helpers.php';

$page_title = "Pengembalian Buku";
$base = "../";
include __DIR__ . '/../includes/header.php';

$stmt = $pdo->query("
    select peminjaman.id, anggota.nama as nama_anggota, buku.judul as judul_buku, peminjaman.tanggal_pinjam 
    from peminjaman 
    join anggota on peminjaman.anggota_id = anggota.id 
    join buku on peminjaman.buku_id = buku.id 
    where peminjaman.status = 'dipinjam' 
    order by peminjaman.id asc
");
$daftar_pinjam = $stmt->fetchAll(PDO::FETCH_ASSOC);

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<section>
    <h2>Daftar Peminjaman</h2>

    <div style="margin-bottom: 1rem;">
        <a href="tambah.php">+ Tambah Peminjaman</a>
    </div>

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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($daftar_pinjam) > 0): ?>
                <?php $no = 1; foreach ($daftar_pinjam as $row): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo e($row['nama_anggota']); ?></td>
                    <td><?php echo e($row['judul_buku']); ?></td>
                    <td><?php echo e($row['tanggal_pinjam']); ?></td>
                    <td>
                        <form action="proses_kembali.php" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" onclick="return confirm('Konfirmasi pengembalian buku ini?')">Kembalikan</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5" style="text-align: center;">Tidak ada buku yang sedang dipinjam.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>