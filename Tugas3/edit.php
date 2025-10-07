<?php include "koneksi.php"; ?>
<?php
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Mahasiswa</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-xl mx-auto">
    <h3 class="text-3xl font-bold mb-6 text-center text-gray-700">Edit Mahasiswa</h3>

    <!-- Pesan sukses/error -->
    <?php
    if(isset($_POST['update'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $prodi = $_POST['prodi'];

        $stmt = $conn->prepare("UPDATE mahasiswa SET nim=?, nama=?, prodi=? WHERE id=?");
        $stmt->bind_param("sssi", $nim, $nama, $prodi, $id);

        if($stmt->execute()) {
            echo '
            <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700 flex justify-between items-center">
                <span>Data berhasil diperbarui!</span>
                <a href="index.php" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
            </div>';
            // Refresh data setelah update agar form menampilkan data terbaru
            $data['nim'] = $nim;
            $data['nama'] = $nama;
            $data['prodi'] = $prodi;
        } else {
            echo '
            <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300 text-red-700 flex justify-between items-center">
                <span>Error: '.$stmt->error.'</span>
                <a href="index.php" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
            </div>';
        }
    }
    ?>

    <!-- Form Edit -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form method="post" onsubmit="return validasi()" class="space-y-4">
            <div>
                <label for="nim" class="block font-semibold mb-1">NIM:</label>
                <input type="text" id="nim" name="nim" value="<?= $data['nim'] ?>" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            <div>
                <label for="nama" class="block font-semibold mb-1">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?= $data['nama'] ?>" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            <div>
                <label for="prodi" class="block font-semibold mb-1">Prodi:</label>
                <input type="text" id="prodi" name="prodi" value="<?= $data['prodi'] ?>" 
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            </div>

            <p id="pesan" class="text-red-500 font-semibold"></p>

            <div class="flex justify-center gap-4 mt-2">
                <input type="submit" name="update" value="Update" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300 cursor-pointer">
                <a href="mahasiswa.php" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
function validasi() {
    let nim = document.querySelector("#nim").value;
    let nama = document.querySelector("#nama").value;
    let prodi = document.querySelector("#prodi").value;

    if(nim.length < 5) {
        document.querySelector("#pesan").innerHTML = "NIM minimal 5 karakter!";
        return false;
    }
    if(nama === "" || prodi === "") {
        document.querySelector("#pesan").innerHTML = "Nama dan Prodi tidak boleh kosong!";
        return false;
    }
    return true;
}
</script>

</body>
</html>
