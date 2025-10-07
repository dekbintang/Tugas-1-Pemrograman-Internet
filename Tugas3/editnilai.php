<?php
include "koneksi.php";
$id = $_GET['id'];

// Ambil data nilai
$stmt = $conn->prepare("SELECT * FROM nilai WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$mid = $data['mahasiswa_id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Nilai Mahasiswa</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 flex items-center justify-center min-h-screen">

<div class="max-w-md w-full bg-white p-6 rounded-lg shadow-lg">
    <h3 class="text-2xl font-bold mb-6 text-center text-gray-700">Edit Nilai Mahasiswa</h3>

    <?php
    if(isset($_POST['update'])){
        $mk = $_POST['mata_kuliah'];
        $sks = $_POST['sks'];
        $nh = $_POST['nilai_huruf'];

        $na = match($nh){
            "A"=>4.00,
            "B"=>3.00,
            "C"=>2.00,
            "D"=>1.00,
            "E"=>0.00
        };

        $stmt = $conn->prepare("UPDATE nilai SET mata_kuliah=?, sks=?, nilai_huruf=?, nilai_angka=? WHERE id=?");
        $stmt->bind_param("sisdi",$mk,$sks,$nh,$na,$id);

        if($stmt->execute()){
            echo '
            <div class="mb-4 p-4 rounded-lg bg-green-100 border border-green-300 text-green-700 flex justify-between items-center">
                <span>Nilai berhasil diperbarui!</span>
                <a href="nilai.php?mahasiswa_id='.$mid.'" class="bg-green-500 hover:bg-green-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
            </div>';
        } else {
            echo '
            <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300 text-red-700 flex justify-between items-center">
                <span>Error: '.$stmt->error.'</span>
                <a href="nilai.php?mahasiswa_id='.$mid.'" class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded shadow transition">Kembali</a>
            </div>';
        }
    }
    ?>

    <form method="post" onsubmit="return validasi()" class="space-y-4">
        <input type="text" id="mk" name="mata_kuliah" placeholder="Mata Kuliah" value="<?= $data['mata_kuliah'] ?>"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

        <input type="number" id="sks" name="sks" placeholder="SKS" value="<?= $data['sks'] ?>"
               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

        <select id="nh" name="nilai_huruf"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
            <option value="">--Pilih Nilai Huruf--</option>
            <option value="A" <?= $data['nilai_huruf']=="A"?"selected":"" ?>>A</option>
            <option value="B" <?= $data['nilai_huruf']=="B"?"selected":"" ?>>B</option>
            <option value="C" <?= $data['nilai_huruf']=="C"?"selected":"" ?>>C</option>
            <option value="D" <?= $data['nilai_huruf']=="D"?"selected":"" ?>>D</option>
            <option value="E" <?= $data['nilai_huruf']=="E"?"selected":"" ?>>E</option>
        </select>

        <p id="pesan" class="text-red-500 font-semibold"></p>

        <div class="flex justify-center gap-4 mt-2">
            <input type="submit" name="update" value="Update"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300 cursor-pointer">
            <a href="nilai.php?mahasiswa_id=<?= $mid ?>"
               class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300">
                Cancel
            </a>
        </div>
    </form>
</div>

<script>
function validasi(){
    let mk = document.querySelector("#mk").value.trim();
    let sks = document.querySelector("#sks").value.trim();
    let nh = document.querySelector("#nh").value;

    if(mk === "" || sks === "" || nh === ""){
        document.querySelector("#pesan").innerText="Semua field wajib diisi!";
        return false;
    }
    if(sks <= 0){
        document.querySelector("#pesan").innerText="SKS harus lebih dari 0!";
        return false;
    }
    return true;
}
</script>

</body>
</html>
