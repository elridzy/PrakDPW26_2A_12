<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sudahLogin = isset($_SESSION['user_id']);
$namaUser = $_SESSION['nama'] ?? '';
$base = $base ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $page_title ?? 'SIMPUS-Mini'; ?></title>
    <!-- Tambahan ?v= time() agar browser tidak menyimpan cache CSS lama -->
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <nav>
            <ul>
                <li><a href="<?php echo $base; ?>index.php">Beranda</a></li>
                <?php if ($sudahLogin): ?>
                    <li><a href="<?php echo $base; ?>buku/list.php">Buku</a></li>
                    <li><a href="<?php echo $base; ?>anggota/list.php">Anggota</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-status">
            <?php if ($sudahLogin): ?>
                <span>Halo, <?php echo htmlspecialchars($namaUser); ?></span>
                <a href="<?php echo $base; ?>auth/logout.php" style="color: #ffc107; font-weight: 600;">Logout</a>
            <?php else: ?>
                <a href="<?php echo $base; ?>auth/login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>
    <main>