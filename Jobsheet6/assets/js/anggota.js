document.addEventListener("DOMContentLoaded", async () => {
    const loadingIndicator = document.getElementById("loading-indicator");
    const tabelAnggota = document.getElementById("tabel-anggota");

    // Tampilkan loading indicator
    if (loadingIndicator) loadingIndicator.style.display = "block";

    try {
        // Simulasi delay 600ms
        await new Promise(resolve => setTimeout(resolve, 600));

        const response = await fetch("../data/anggota.json");
        
        if (!response.ok) {
            throw new Error("Gagal mengambil data anggota.");
        }

        const dataAnggota = await response.json();
        tabelAnggota.innerHTML = "";

        dataAnggota.forEach(anggota => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${anggota.no_anggota}</td>
                <td>${anggota.nama}</td>
                <td>${anggota.alamat}</td>
                <td>${anggota.no_hp}</td>
                <td>
                    <button type="button" class="btn-edit">Edit</button>
                    <button type="button" class="btn-detail">Detail</button>
                    <button type="button" class="btn-hapus">Hapus</button>
                </td>
            `;
            tabelAnggota.appendChild(row);
        });

    } catch (error) {
        console.error("Terjadi kesalahan:", error);
        // Menampilkan pesan error di dalam tabel jika fetch gagal
        tabelAnggota.innerHTML = `<tr><td colspan="5" style="color: red; text-align: center;">Gagal memuat data anggota.</td></tr>`;
    } finally {
        // Sembunyikan loading indicator setelah selesai
        if (loadingIndicator) loadingIndicator.style.display = "none";
    }
});