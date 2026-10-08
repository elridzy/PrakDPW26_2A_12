<?php
session_start();
$page_title = "Registrasi Petugas";
$base = "../";
include '../includes/header.php';
?>

<section>
    <h2>Registrasi Petugas Baru</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red; margin-bottom: 1rem;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="proses_register.php" method="POST">
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Daftar</button>
    </form>
    <p style="margin-top: 1rem;">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</section>

<?php include '../includes/footer.php'; ?>