<?php
session_start();
$page_title = "Login Petugas";
$base = "../";
include '../includes/header.php';
?>

<section>
    <h2>Login Petugas</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red; margin-bottom: 1rem;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash'])): ?>
        <p style="color: green; margin-bottom: 1rem;"><?php echo $_SESSION['flash']; unset($_SESSION['flash']); ?></p>
    <?php endif; ?>

    <form action="proses_login.php" method="POST">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    <p style="margin-top: 1rem;">Belum punya akun? <a href="register.php">Registrasi di sini</a></p>
</section>

<?php include '../includes/footer.php'; ?>