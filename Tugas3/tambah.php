<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Mahasiswa</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 flex items-center justify-center min-h-screen">

<div class="max-w-md w-full bg-white p-6 rounded-lg shadow-lg">
    <h3 class="text-2xl font-bold mb-6 text-center text-gray-700">Tambah Mahasiswa</h3>

    <!-- Pesan sukses/error -->
    <?php
    if(isset($_POST['simpan'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $prodi = $_POST['prodi'];

        // Cek apakah NIM sudah ada
        $cek = $conn->prepare("SELECT * FROM mahasiswa WHERE nim=?");
        $cek->bind_param("s", $nim);
        $cek->execute();
        $hasilCek = $cek->get_result();

        if($hasilCek->num_rows > 0){
            echo '
            <div class="mb-4 p-4 rounded-lg bg-yellow-100 border border-yellow-300 text-yellow-700 flex justify-between items-center">
                <span>Data dengan NIM '.$nim.' sudah ditambahkan!</span>
                <a href="index.php" class="bg-yellow-500 hover:bg-yellow-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
            </div>';
        } else {
            $stmt = $conn->prepare("INSERT INTO mahasiswa (nim, nama, prodi) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nim, $nama, $prodi);

            if($stmt->execute()) {
                echo '
                <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700 flex justify-between items-center">
                    <span>Data berhasil disimpan!</span>
                    <a href="index.php" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
                </div>';
                // Kosongkan field setelah berhasil simpan
                $nim = $nama = $prodi = "";
            } else {
                echo '
                <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300 text-red-700 flex justify-between items-center">
                    <span>Error: '.$stmt->error.'</span>
                    <a href="index.php" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
                </div>';
            }
        }
    }
    ?>

    <form method="post" onsubmit="return validasi()" class="space-y-4">
        <input type="text" id="nim" name="nim" placeholder="NIM" value="<?= isset($nim)?$nim:'' ?>" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

        <input type="text" id="nama" name="nama" placeholder="Nama" value="<?= isset($nama)?$nama:'' ?>" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

        <input type="text" id="prodi" name="prodi" placeholder="Prodi" value="<?= isset($prodi)?$prodi:'' ?>" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

        <p id="error" class="text-red-500 font-semibold"></p>

        <div class="flex justify-center gap-4 mt-2">
            <input type="submit" name="simpan" value="Simpan" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300 cursor-pointer">
            <a href="mahasiswa.php" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300">Kembali</a>
        </div>
    </form>
</div>

<script>
function validasi() {
    let nim = document.querySelector("#nim").value;
    let nama = document.querySelector("#nama").value;
    let prodi = document.querySelector("#prodi").value;

    if(nim.length < 5) {
        document.querySelector("#error").innerHTML = "NIM minimal 5 karakter!";
        return false;
    }
    if(nama === "" || prodi === "") {
        document.querySelector("#error").innerHTML = "Nama dan Prodi tidak boleh kosong!";
        return false;
    }
    return true;
}
</script>

</body>
</html>
