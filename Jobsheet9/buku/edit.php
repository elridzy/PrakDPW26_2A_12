<?php
session_start();
$page_title = "Edit Buku";
$base = "../";
include '../includes/header.php';
include '../includes/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: list.php");
    exit;
}

// Ambil data buku berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = ?");
$stmt->execute([$id]);
$buku = $stmt->fetch();

if (!$buku) {
    header("Location: list.php");
    exit;
}
?>

<h2>Edit Buku</h2>

<form action="proses_edit.php" method="POST">
    <input type="hidden" name="id" value="<?= $buku['id']; ?>">
    
    <p>
        <label>Judul Buku:</label>
        <input type="text" name="judul" value="<?= htmlspecialchars($buku['judul']); ?>" required>
    </p>
    <p>
        <label>Pengarang:</label>
        <input type="text" name="pengarang" value="<?= htmlspecialchars($buku['pengarang']); ?>" required>
    </p>
    <p>
        <label>Tahun Terbit:</label>
        <input type="number" name="tahun" value="<?= htmlspecialchars($buku['tahun']); ?>" required>
    </p>
    <p>
        <label>Stok:</label>
        <input type="number" name="stok" value="<?= htmlspecialchars($buku['stok']); ?>" required>
    </p>
    
    <button type="submit">Simpan Perubahan</button>
</form>

<?php include '../includes/footer.php'; ?>