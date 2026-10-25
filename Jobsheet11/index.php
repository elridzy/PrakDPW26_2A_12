<?php
require_once 'includes/auth.php';
cekLogin();
$page_title = "Beranda SIMPUS-Mini";
$base = "";
include 'includes/header.php';
?>

<section>
    <h2>Selamat Datang di SIMPUS-Mini</h2>
    <p>Sistem Informasi Perpustakaan Sederhana - Politeknik Negeri Malang</p>
    <?php if (isset($_SESSION['nama'])): ?>
        <p style="margin-top: 1rem; color: #0056b3; font-weight: 600;">
            Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?>! Anda login sebagai Petugas.
        </p>
    <?php endif; ?>
</section>

<section>
    <article>
        <h3>Total Buku</h3>
        <p>12</p>
    </article>
    <article>
        <h3>Total Anggota</h3>
        <p>8</p>
    </article>
    <article>
        <h3>Peminjaman Aktif</h3>
        <p>3</p>
    </article>
    <article>
        <h3>Keterlambatan</h3>
        <p>0</p>
    </article>
</section>

<?php include 'includes/footer.php'; ?>