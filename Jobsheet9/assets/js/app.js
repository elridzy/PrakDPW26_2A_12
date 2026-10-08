document.addEventListener("DOMContentLoaded", function () {
    // Memanggil fungsi inisialisasi konfirmasi hapus
    initHapusConfirm();
});

function initHapusConfirm() {
    // Menangkap event submit pada form hapus
    document.addEventListener("submit", function (e) {
        // Memeriksa apakah form yang disubmit memiliki class "form-hapus"
        if (e.target && e.target.classList.contains("form-hapus")) {
            // Memunculkan dialog konfirmasi sebelum form dikirim ke hapus.php
            const yakin = confirm("Yakin ingin menghapus data ini?");
            if (!yakin) {
                // Jika pengguna memilih "Cancel", batalkan proses submit form
                e.preventDefault();
            }
        }
    });
}