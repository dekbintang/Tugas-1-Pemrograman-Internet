<?php
include "koneksi.php";
$mid = $_GET['mahasiswa_id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Nilai Mahasiswa</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 flex items-center justify-center min-h-screen">

<div class="max-w-md w-full bg-white p-6 rounded-lg shadow-lg">
    <h3 class="text-2xl font-bold mb-6 text-center text-gray-700">Tambah Nilai</h3>

    <!-- Pesan sukses/error -->
    <?php
    if(isset($_POST['simpan'])) {
        $mk = $_POST['mata_kuliah'];
        $sks = $_POST['sks'];
        $nh = $_POST['nilai_huruf'];

        // Cek apakah mata kuliah sudah ada untuk mahasiswa ini
        $cek = $conn->prepare("SELECT * FROM nilai WHERE mahasiswa_id=? AND mata_kuliah=?");
        $cek->bind_param("is", $mid, $mk);
        $cek->execute();
        $hasilCek = $cek->get_result();

        if($hasilCek->num_rows > 0){
            echo '
            <div class="mb-4 p-4 rounded-lg bg-yellow-100 border border-yellow-300 text-yellow-700 flex justify-between items-center">
                <span>Nilai untuk mata kuliah '.$mk.' sudah ada!</span>
                <a href="nilai.php?mahasiswa_id='.$mid.'" class="bg-yellow-500 hover:bg-yellow-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
            </div>';
        } else {
            $na = match($nh){
                "A"=>4.00,
                "B"=>3.00,
                "C"=>2.00,
                "D"=>1.00,
                "E"=>0.00
            };

            $stmt = $conn->prepare("INSERT INTO nilai (mahasiswa_id, mata_kuliah, sks, nilai_huruf, nilai_angka) VALUES (?,?,?,?,?)");
            $stmt->bind_param("isisd", $mid, $mk, $sks, $nh, $na);

            if($stmt->execute()) {
                echo '
                <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700 flex justify-between items-center">
                    <span>Nilai berhasil disimpan!</span>
                    <a href="nilai.php?mahasiswa_id='.$mid.'" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
                </div>';
                $mk = $sks = $nh = "";
            } else {
                echo '
                <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300 text-red-700 flex justify-between items-center">
                    <span>Error: '.$stmt->error.'</span>
                    <a href="nilai.php?mahasiswa_id='.$mid.'" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
                </div>';
            }
        }
    }
    ?>

    <form method="post" onsubmit="return validasi()" class="space-y-4">
        <input type="text" id="mk" name="mata_kuliah" placeholder="Mata Kuliah" value="<?= isset($mk)?$mk:'' ?>" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

        <input type="number" id="sks" name="sks" placeholder="SKS" value="<?= isset($sks)?$sks:'' ?>" 
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

        <select id="nh" name="nilai_huruf" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            <option value="">--Pilih Nilai Huruf--</option>
            <option value="A" <?= (isset($nh) && $nh=="A")?"selected":"" ?>>A</option>
            <option value="B" <?= (isset($nh) && $nh=="B")?"selected":"" ?>>B</option>
            <option value="C" <?= (isset($nh) && $nh=="C")?"selected":"" ?>>C</option>
            <option value="D" <?= (isset($nh) && $nh=="D")?"selected":"" ?>>D</option>
            <option value="E" <?= (isset($nh) && $nh=="E")?"selected":"" ?>>E</option>
        </select>

        <p id="error" class="text-red-500 font-semibold"></p>

        <div class="flex justify-center gap-4 mt-2">
            <input type="submit" name="simpan" value="Simpan" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300 cursor-pointer">
            <a href="nilai.php?mahasiswa_id=<?= $mid ?>" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300">Kembali</a>
        </div>
    </form>
</div>

<script>
function validasi() {
    let mk = document.querySelector("#mk").value.trim();
    let sks = document.querySelector("#sks").value.trim();
    let nh = document.querySelector("#nh").value;

    if(mk === "" || sks === "" || nh === "") {
        document.querySelector("#error").innerHTML = "Semua field wajib diisi!";
        return false;
    }
    if(sks <= 0) {
        document.querySelector("#error").innerHTML = "SKS harus lebih dari 0!";
        return false;
    }
    return true;
}
</script>

</body>
</html>
