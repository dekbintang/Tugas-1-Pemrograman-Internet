<?php
include "koneksi.php";
$mid = $_GET['mahasiswa_id'] ?? null;

if (!$mid) {
    die("<div class='text-center text-red-500 font-semibold mt-10'>Mahasiswa tidak ditemukan.</div>");
}

$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id=?");
$stmt->bind_param("i", $mid);
$stmt->execute();
$mahasiswa = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Nilai Mahasiswa</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10 flex justify-center min-h-screen">

<div class="max-w-5xl w-full bg-white shadow-lg rounded-xl border border-gray-200 p-8">
    <!-- Judul -->
    <div class="flex justify-between items-start mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Nilai Mahasiswa</h1>
            <p class="text-gray-500 text-sm">Data nilai lengkap mahasiswa yang terdaftar</p>
        </div>
        <div class="flex gap-3">
            <a href="tambahnilai.php?mahasiswa_id=<?= $mid ?>" 
               class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-lg font-medium shadow-md transition">
               Tambah Nilai
            </a>
            <a href="mahasiswa.php" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg font-medium shadow-md transition">
               Kembali
            </a>
        </div>
    </div>

    <!-- Info Mahasiswa -->
    <div class="bg-gradient-to-r from-teal-50 to-blue-50 border border-teal-100 rounded-lg p-5 mb-6 shadow-sm text-gray-700">
        <p><span class="font-semibold text-teal-700">Nama:</span> <?= htmlspecialchars($mahasiswa['nama']) ?></p>
        <p><span class="font-semibold text-teal-700">NIM:</span> <?= htmlspecialchars($mahasiswa['nim']) ?></p>
        <p><span class="font-semibold text-teal-700">Prodi:</span> <?= htmlspecialchars($mahasiswa['prodi']) ?></p>
    </div>

    <!-- Tabel Nilai -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gradient-to-r from-teal-500 to-teal-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Mata Kuliah</th>
                    <th class="py-3 px-4 text-left">SKS</th>
                    <th class="py-3 px-4 text-left">Nilai Huruf</th>
                    <th class="py-3 px-4 text-left">Nilai Angka</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                <?php
                $stmt = $conn->prepare("SELECT * FROM nilai WHERE mahasiswa_id=? ORDER BY id ASC");
                $stmt->bind_param("i", $mid);
                $stmt->execute();
                $result = $stmt->get_result();

                $no = 1;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <tr class='hover:bg-gray-50 transition'>
                            <td class='py-3 px-4 text-gray-700 font-medium'>{$no}</td>
                            <td class='py-3 px-4 text-gray-700'>".htmlspecialchars($row['mata_kuliah'])."</td>
                            <td class='py-3 px-4 text-gray-700'>{$row['sks']}</td>
                            <td class='py-3 px-4 text-gray-700'>{$row['nilai_huruf']}</td>
                            <td class='py-3 px-4 text-gray-700'>{$row['nilai_angka']}</td>
                            <td class='py-3 px-4 text-center'>
                                <div class='flex justify-center gap-2'>
                                    <a href='editnilai.php?id={$row['id']}&mahasiswa_id=$mid' 
                                       class='bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-md text-xs shadow transition'>
                                       Edit
                                    </a>
                                    <a href='hapusnilai.php?id={$row['id']}&mahasiswa_id=$mid' 
                                       class='bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs shadow transition'
                                       onclick='return confirm(\"Yakin ingin menghapus nilai ini?\")'>
                                       Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='py-4 text-center text-gray-500 italic'>Belum ada data nilai</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
