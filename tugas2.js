const daftarMahasiswa = document.getElementById("daftarMahasiswa");
const tombolTambah = document.getElementById("tambahMahasiswa");

tombolTambah.addEventListener("click", function () {

    const jumlah = daftarMahasiswa.querySelectorAll(".mahasiswa").length + 1;

    const formBaru = document.createElement("div");
    formBaru.className = "mahasiswa";

    formBaru.innerHTML = `
        <h3>Mahasiswa ${jumlah}</h3>

        <label>Nama Mahasiswa:</label>
        <input type="text" name="nama[]" required>

        <label>NIM:</label>
        <input type="text" name="nim[]" required>

        <label>Nilai Tugas:</label>
        <input type="number" name="tugas[]" step="any" required>

        <label>Nilai UTS:</label>
        <input type="number" name="uts[]" step="any" required>

        <label>Nilai UAS:</label>
        <input type="number" name="uas[]" step="any" required>
    `;

    daftarMahasiswa.appendChild(formBaru);
});