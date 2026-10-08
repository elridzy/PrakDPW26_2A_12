<?php
$page_title = "Edit Anggota";
$base = "../";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

// 1. Ambil ID dari URL (?id=...)
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

// 2. Ambil data anggota yang lama dari database berdasarkan ID
$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute(['id' => $id]);
$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika data tidak ditemukan di database
if (!$anggota) {
    header('Location: list.php');
    exit;
}
?>

<section>
    <h2>Edit Anggota</h2>
    
    <!-- Form diarahkan ke proses_edit.php -->
    <form action="proses_edit.php" method="post" id="form-tambah">
        
        <!-- Input tersembunyi untuk membawa ID baris yang diubah -->
        <input type="hidden" name="id" value="<?php echo $anggota['id']; ?>">

        <label for="nama">Nama Anggota:</label><br>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($anggota['nama']); ?>" required><br><br>

        <label for="no_anggota">No Anggota / ID:</label><br>
        <input type="text" id="no_anggota" name="no_anggota" value="<?php echo htmlspecialchars($anggota['no_anggota']); ?>" required><br><br>

        <label for="alamat">Alamat:</label><br>
        <textarea id="alamat" name="alamat" required><?php echo htmlspecialchars($anggota['alamat']); ?></textarea><br><br>

        <label for="no_hp">No Telepon:</label><br>
        <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($anggota['no_hp']); ?>" required><br><br>

        <button type="submit" class="btn-edit">Simpan Perubahan</button>
    </form>
</section>

<?php 
include __DIR__ . '/../includes/footer.php'; 
?>