<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('Location: list.php');
    exit;
}

$page_title = "Edit Buku";
$base = "../";
include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Form Edit Buku</h2>
    <form action="proses_edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">
        <div class="form-group">
            <label>Judul Buku:</label>
            <input type="text" name="judul" value="<?php echo htmlspecialchars($buku['judul']); ?>" required>
        </div>
        <div class="form-group">
            <label>Pengarang:</label>
            <input type="text" name="pengarang" value="<?php echo htmlspecialchars($buku['pengarang']); ?>" required>
        </div>
        <div class="form-group">
            <label>Tahun Terbit:</label>
            <input type="number" name="tahun" value="<?php echo htmlspecialchars($buku['tahun']); ?>" required>
        </div>
        <div class="form-group">
            <label>Stok:</label>
            <input type="number" name="stok" value="<?php echo htmlspecialchars($buku['stok']); ?>" required>
        </div>
        <button type="submit">Simpan Perubahan</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>