<?php
include "koneksi.php";
$id = $_GET['id'];
$mid = $_GET['mahasiswa_id'];

$stmt = $conn->prepare("DELETE FROM nilai WHERE id=?");
$stmt->bind_param("i", $id);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Hapus Nilai Mahasiswa</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 flex items-center justify-center min-h-screen">

<div class="max-w-xl w-full">
<?php
if ($stmt->execute()) {
    echo '
    <div class="p-6 bg-green-100 border border-green-300 text-green-700 rounded-lg shadow-lg flex justify-between items-center">
        <span class="font-medium">Nilai mahasiswa berhasil dihapus!</span>
        <a href="nilai.php?mahasiswa_id='.$mid.'" 
           class="bg-green-500 hover:bg-green-700 text-white font-semibold py-1 px-4 rounded shadow transition">
           Kembali
        </a>
    </div>';
} else {
    echo '
    <div class="p-6 bg-red-100 border border-red-300 text-red-700 rounded-lg shadow-lg flex justify-between items-center">
        <span class="font-medium">Error: '.$stmt->error.'</span>
        <a href="nilai.php?mahasiswa_id='.$mid.'" 
           class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded shadow transition">
           Kembali
        </a>
    </div>';
}
?>
</div>

</body>
</html>
