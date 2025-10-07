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

<script>
function loadMahasiswa(keyword = "") {
    fetch("cari.php?keyword=" + encodeURIComponent(keyword))
    .then(res => res.json())
    .then(data => {
        let isi = "";
        data.forEach((m, index) => { // index digunakan untuk nomor urut
            isi += `<tr class="hover:bg-gray-100 transition">
                <td class="py-2 px-4">${index + 1}</td>
                <td class="py-2 px-4">${m.nim}</td>
                <td class="py-2 px-4">${m.nama}</td>
                <td class="py-2 px-4">${m.prodi}</td>
                <td class="py-2 px-4 text-right flex justify-end gap-2">
                    <a href='edit.php?id=${m.id}' class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-3 rounded shadow-sm transition">Edit</a>
                    <a href='hapus.php?id=${m.id}' class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded shadow-sm transition">Hapus</a>
                    <a href='nilai.php?mahasiswa_id=${m.id}' class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded shadow-sm transition">Nilai</a>
                </td>
            </tr>`;
        });
        document.querySelector("#hasil").innerHTML = isi;
    });
}

document.querySelector("#keyword").oninput = function() {
    loadMahasiswa(this.value);
};

loadMahasiswa();
</script>

</body>
</html>
