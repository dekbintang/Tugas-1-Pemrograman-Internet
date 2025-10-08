<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>CRUD Mahasiswa</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-6xl mx-auto">
    <h3 class="text-3xl font-bold mb-6 text-center text-gray-700">Daftar Mahasiswa</h3>

    <!-- Container tombol tambah & search -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <input type="text" id="keyword" placeholder="Cari mahasiswa..." class="border border-gray-300 rounded px-4 py-2 w-full sm:w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
        <div class="flex justify-end w-full sm:w-auto">
            <a href="tambah.php" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md transition duration-300">
                Tambah Mahasiswa
            </a>
        </div>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-3 px-4 text-left w-12">No</th>
                    <th class="py-3 px-4 text-left w-32">NIM</th>
                    <th class="py-3 px-4 text-left">Nama</th>
                    <th class="py-3 px-4 text-left">Prodi</th>
                    <th class="py-3 px-4 text-right w-52">Aksi</th>
                </tr>
            </thead>
            <tbody id="hasil" class="divide-y divide-gray-200"></tbody>
        </table>
    </div>
</div>

<!-- Modal Hapus -->
<div id="modalHapus" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl p-6 w-80 max-w-full">
        <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Konfirmasi Hapus</h2>
        <p class="text-gray-600 mb-6 text-center">Apakah kamu yakin ingin menghapus mahasiswa ini?</p>
        <div class="flex justify-center gap-3">
            <button id="btnBatal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-1.5 px-4 rounded-lg transition">Tidak</button>
            <button id="btnHapusConfirm" class="bg-red-500 hover:bg-red-600 text-white font-medium py-1.5 px-4 rounded-lg transition">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
let hapusId = null;

function loadMahasiswa(keyword = "") {
    fetch("cari.php?keyword=" + encodeURIComponent(keyword))
    .then(res => res.json())
    .then(data => {
        let isi = "";
        data.forEach((m, index) => {
            isi += `<tr class="hover:bg-gray-100 transition">
                <td class="py-2 px-4">${index + 1}</td>
                <td class="py-2 px-4">${m.nim}</td>
                <td class="py-2 px-4">${m.nama}</td>
                <td class="py-2 px-4">${m.prodi}</td>
                <td class="py-2 px-4 text-right flex justify-end gap-2">
                    <a href='edit.php?id=${m.id}' class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-3 rounded shadow-sm transition">Edit</a>
                    <button onclick="showHapusModal(${m.id})" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded shadow-sm transition">Hapus</button>
                    <a href='nilai.php?mahasiswa_id=${m.id}' class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded shadow-sm transition">Nilai</a>
                </td>
            </tr>`;
        });
        document.querySelector("#hasil").innerHTML = isi;
    });
}

// Modal Hapus
function showHapusModal(id) {
    hapusId = id;
    document.getElementById("modalHapus").classList.remove("hidden");
}

// Tombol Batal
document.getElementById("btnBatal").addEventListener("click", () => {
    hapusId = null;
    document.getElementById("modalHapus").classList.add("hidden");
});

// Tombol Hapus Konfirmasi
document.getElementById("btnHapusConfirm").addEventListener("click", () => {
    if (hapusId) {
        fetch("hapus.php?id=" + hapusId, { method: "GET" })
            .then(res => res.text())
            .then(res => {
                document.getElementById("modalHapus").classList.add("hidden");
                hapusId = null;
                loadMahasiswa(); // reload data mahasiswa tanpa refresh
            })
            .catch(err => {
                console.error(err);
                document.getElementById("modalHapus").classList.add("hidden");
                hapusId = null;
            });
    }
});

document.querySelector("#keyword").oninput = function() {
    loadMahasiswa(this.value);
};

loadMahasiswa();
</script>

</body>
</html>
