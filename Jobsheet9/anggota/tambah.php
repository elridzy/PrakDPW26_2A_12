<?php
session_start();
$page_title = "Tambah Anggota";
$base = "../";
include '../includes/header.php';
require_once '../includes/koneksi.php';

// Proses penyimpanan jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $no_anggota = $_POST['no_anggota'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    try {
        $stmt = $pdo->prepare("INSERT INTO anggota (nama, no_anggota, alamat, no_hp) VALUES (:nama, :no_anggota, :alamat, :no_hp)");
        $stmt->execute([
            'nama' => $nama,
            'no_anggota' => $no_anggota,
            'alamat' => $alamat,
            'no_hp' => $no_hp
        ]);

        $_SESSION['flash'] = "Data anggota berhasil ditambahkan!";
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        $error = "Gagal menyimpan data: " . $e->getMessage();
    }
}
?>

<h2>Form Tambah Anggota</h2>

<?php if (isset($error)): ?>
    <p style="color: red; margin-bottom: 1rem;"><?php echo $error; ?></p>
<?php endif; ?>

<form action="" method="POST">
    <div class="form-group">
        <label>Nama Lengkap:</label>
        <input type="text" name="nama" required>
    </div>
    <div class="form-group">
        <label>No Anggota / ID:</label>
        <input type="text" name="no_anggota" required>
    </div>
    <div class="form-group">
        <label>Alamat:</label>
        <textarea name="alamat" required style="width: 100%; max-width: 480px; padding: 0.55rem 0.7rem; border: 1px solid #cccccc; border-radius: 4px; font-size: 1rem; font-family: inherit;"></textarea>
    </div>
    <div class="form-group">
        <label>No Telepon:</label>
        <input type="text" name="no_hp" required>
    </div>
    <button type="submit" class="btn" style="margin-top: 0.25rem;">Simpan Anggota</button>
</form>

<?php include '../includes/footer.php'; ?>