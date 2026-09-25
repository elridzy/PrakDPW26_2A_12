document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});

// 1. Menu Hamburger Interaktif
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");

    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

// 2. Tombol Hapus dengan Konfirmasi (Front-end)
function initHapusConfirm() {
    const deleteButtons = document.querySelectorAll(".btn-hapus");

    if (deleteButtons.length === 0) return;

    deleteButtons.forEach(function (button) {
        button.addEventListener("click", function (e) {
            const confirmed = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (!confirmed) {
                e.preventDefault();
            } else {
                const row = button.closest("tr");
                if (row) row.remove();
            }
        });
    });
}

// 3. Filter Tabel Real-Time
function initTableFilter() {
    const searchInput = document.getElementById("search-input");
    const table = document.querySelector("table");

    if (!searchInput || !table) return;

    const rows = table.querySelectorAll("tbody tr");

    searchInput.addEventListener("keyup", function () {
        const keyword = searchInput.value.toLowerCase();

        rows.forEach(function (row) {
            const text = row.textContent.toLowerCase();
            if (text.includes(keyword)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
}

// 4. Validasi Form Sisi Klien (Client-Side)
function initValidasiForm() {
    const form = document.getElementById("form-tambah");

    if (!form) return;

    form.addEventListener("submit", function (e) {
        let isValid = true;

        const oldErrors = form.querySelectorAll(".error-message");
        oldErrors.forEach(el => el.remove());

        const inputs = form.querySelectorAll("input[required], select[required], textarea[required]");

        inputs.forEach(function (input) {
            if (!input.value.trim()) {
                isValid = false;
                showError(input, "Field ini wajib diisi.");
            }
        });

        const stokInput = document.getElementById("stok");
        if (stokInput && parseInt(stokInput.value) < 0) {
            isValid = false;
            showError(stokInput, "Stok tidak boleh bernilai negatif.");
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
}

function showError(inputElement, message) {
    const errorSpan = document.createElement("small");
    errorSpan.className = "error-message";
    errorSpan.style.color = "red";
    errorSpan.style.display = "block";
    errorSpan.style.marginTop = "4px";
    errorSpan.textContent = message;

    inputElement.insertAdjacentElement("afterend", errorSpan);
}