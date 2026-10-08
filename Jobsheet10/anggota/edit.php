<?php
require_once __DIR__ . '/../includes/auth.php';
cekLogin();
require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute(['id' => $id]);
$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anggota) {
    header('Location: list.php');
    exit;
}

$page_title = "Edit Anggota";
$base = "../";
include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Form Edit Anggota</h2>
    <form action="proses_edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $anggota['id']; ?>">
        <div class="form-group">
            <label>Nama Lengkap:</label>
            <input type="text" name="nama" value="<?php echo htmlspecialchars($anggota['nama']); ?>" required>
        </div>
        <div class="form-group">
            <label>No Anggota / ID:</label>
            <input type="text" name="no_anggota" value="<?php echo htmlspecialchars($anggota['no_anggota']); ?>" required>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" required><?php echo htmlspecialchars($anggota['alamat']); ?></textarea>
        </div>
        <div class="form-group">
            <label>No Telepon:</label>
            <input type="text" name="no_hp" value="<?php echo htmlspecialchars($anggota['no_hp']); ?>" required>
        </div>
        <button type="submit">Simpan Perubahan</button>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>