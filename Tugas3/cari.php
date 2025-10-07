<?php
include "koneksi.php";
$keyword = $_GET['keyword'] ?? "";
$result = $conn->query("SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%'");
$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}
header('Content-Type: application/json');
echo json_encode($data);
?>
