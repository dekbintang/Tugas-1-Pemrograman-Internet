<?php
$mahasiswa = [
    ["nim"=>"2405551040", "nama"=>"ricco", "umur"=>20, "prodi"=>"Teknologi Informasi"],
    ["nim"=>"2405551002", "nama"=>"Listya", "umur"=>19, "prodi"=>"Teknologi Informasi"],
    ["nim"=>"2405551003", "nama"=>"Made Wirawan", "umur"=>21, "prodi"=>"Teknologi Informasi"],
    ["nim"=>"2405551004", "nama"=>"Audy", "umur"=>18, "prodi"=>"Teknologi Informasi"],
    ["nim"=>"2405551005", "nama"=>"Gian", "umur"=>22, "prodi"=>"Teknologi Informasi"],
    ["nim"=>"2405551006", "nama"=>"Adit", "umur"=>20, "prodi"=>"Teknologi Informasi"],
    ["nim"=>"2405551007", "nama"=>"Andi", "umur"=>19, "prodi"=>"Teknologi Informasi"],
    ["nim"=>"2405551008", "nama"=>"Bisma", "umur"=>21, "prodi"=>"Teknologi Informasi"],
    ["nim"=>"2405551009", "nama"=>"Agus cuel", "umur"=>20, "prodi"=>"Teknologi Informasi"],
    ["nim"=>"2405551010", "nama"=>"Kadek budi", "umur"=>18, "prodi"=>"Teknologi Informasi"],
];

echo "<h3>Data Mahasiswa:</h3>";
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr><th>NIM</th><th>Nama</th><th>Umur</th><th>Program Studi</th></tr>";

foreach ($mahasiswa as $mhs) {
    echo "<tr>";
    echo "<td align='center'>{$mhs['nim']}</td>";
    echo "<td>{$mhs['nama']}</td>";
    echo "<td align='center'>{$mhs['umur']}</td>";
    echo "<td>{$mhs['prodi']}</td>";
    echo "</tr>";
}

echo "</table>";
?>