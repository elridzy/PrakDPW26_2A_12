<?php
require_once __DIR__ . '/includes/auth.php';
cekLogin();
require_once __DIR__ . '/includes/koneksi.php';
require_once __DIR__ . '/includes/helpers.php';

$page_title = "Beranda SIMPUS-Mini";
$base = "";
include __DIR__ . '/includes/header.php';

try {
    $stmtBuku = $pdo->query("SELECT COUNT(*) FROM buku");
    $total_buku = $stmtBuku->fetchColumn();

    $stmtAnggota = $pdo->query("SELECT COUNT(*) FROM anggota");
    $total_anggota = $stmtAnggota->fetchColumn();

    $stmtPinjam = $pdo->query("SELECT COUNT(*) FROM peminjaman WHERE status = 'dipinjam'");
    $peminjaman_aktif = $stmtPinjam->fetchColumn();

    $keterlambatan = 0; 
} catch (Exception $e) {
    $total_buku = 0;
    $total_anggota = 0;
    $peminjaman_aktif = 0;
    $keterlambatan = 0;
}
?>

<section>
    <h2>Selamat Datang di SIMPUS-Mini</h2>
    <p>Sistem Informasi Perpustakaan Sederhana - Politeknik Negeri Malang</p>
    <p style="margin-top: 0.75rem;">Halo, <?php echo e($_SESSION['nama'] ?? 'Petugas'); ?>! Anda login sebagai Petugas.</p>
</section>

<section>
    <article>
        <h3>Total Buku</h3>
        <p><?php echo $total_buku; ?></p>
    </article>
    <article>
        <h3>Total Anggota</h3>
        <p><?php echo $total_anggota; ?></p>
    </article>
    <article>
        <h3>Peminjaman Aktif</h3>
        <p><?php echo $peminjaman_aktif; ?></p>
    </article>
    <article>
        <h3>Keterlambatan</h3>
        <p><?php echo $keterlambatan; ?></p>
    </article>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>