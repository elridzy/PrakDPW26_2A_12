document.addEventListener("DOMContentLoaded", () => {
    // Fungsi event delegation untuk tombol hapus / konfirmasi hapus
    document.addEventListener("click", function (event) {
        // Cek apakah yang diklik adalah tombol dengan kelas .btn-hapus
        if (event.target && event.target.classList.contains("btn-hapus")) {
            const konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (konfirmasi) {
                // Logika jika data jadi dihapus
                console.log("Data berhasil dihapus.");
                // Contoh menghapus baris tabel secara dinamis:
                const row = event.target.closest("tr");
                if (row) row.remove();
            }
        }
    });

    // Toggle menu navigasi (hamburger) jika ada
    const navToggleBtn = document.getElementById("nav-toggle-btn");
    const navMenu = document.querySelector("header nav");
    if (navToggleBtn && navMenu) {
        navToggleBtn.addEventListener("click", () => {
            navMenu.classList.toggle("active");
        });
    }
});