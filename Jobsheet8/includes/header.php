<?php
if (!isset($base)) { $base = ""; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? "SIMPUS-Mini"; ?></title>
    <link rel="stylesheet" href="<?= $base; ?>assets/css/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">SIMPUS-Mini</div>
            <ul>
                <li><a href="<?= $base; ?>index.php">Beranda</a></li>
                <li><a href="<?= $base; ?>buku/list.php">Buku</a></li>
                <li><a href="<?= $base; ?>anggota/list.php">Anggota</a></li>
                <li><a href="<?= $base; ?>reset.php" onclick="return confirm('Yakin ingin mereset semua data session?');" style="color: #ffcccc;">Reset Data</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">