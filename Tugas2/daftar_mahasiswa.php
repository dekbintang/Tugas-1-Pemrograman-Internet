<?php
$mahasiswa = [
    "2405551049" => "Bintang",
    "2405551019" => "Mozart",
    "2405551034" => "Cahya",
    "2405551004" => "Budii",
    "2405551005" => "Ricco"
];

echo "<h3>Daftar Mahasiswa:</h3>";
echo "<ul>";
foreach ($mahasiswa as $nim => $nama) {
    echo "<li>NIM: $nim, Nama: $nama</li>";
}
echo "</ul>";
?>
