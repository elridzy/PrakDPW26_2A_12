document.addEventListener("DOMContentLoaded", async () => {
    const loadingIndicator = document.getElementById("loading-indicator");
    const tabelBuku = document.getElementById("tabel-buku");

    // Tampilkan loading indicator
    if (loadingIndicator) loadingIndicator.style.display = "block";

    try {
        // Simulasi delay 600ms
        await new Promise(resolve => setTimeout(resolve, 600));

        const response = await fetch("../data/buku.json");
        
        if (!response.ok) {
            throw new Error("Gagal mengambil data buku.");
        }

        const dataBuku = await response.json();
        tabelBuku.innerHTML = "";

        dataBuku.forEach(buku => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${buku.judul}</td>
                <td>${buku.pengarang}</td>
                <td>${buku.tahun}</td>
                <td>${buku.stok}</td>
                <td>
                    <button type="button" class="btn-edit">Edit</button>
                    <button type="button" class="btn-detail">Detail</button>
                    <button type="button" class="btn-hapus">Hapus</button>
                </td>
            `;
            tabelBuku.appendChild(row);
        });

    } catch (error) {
        console.error("Terjadi kesalahan:", error);
        // Menampilkan pesan error di dalam tabel jika fetch gagal
        tabelBuku.innerHTML = `<tr><td colspan="5" style="color: red; text-align: center;">Gagal memuat data buku.</td></tr>`;
    } finally {
        // Sembunyikan loading indicator setelah selesai
        if (loadingIndicator) loadingIndicator.style.display = "none";
    }
});