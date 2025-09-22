<?php
$hargaBarang = [
    "keyboard" => 150000,
    "Mouse" => 50000,
    "jam Tangan" => 100000,
    "Charger" => 150000,
    "Aqua" => 3000
];

echo "<h3>Daftar Harga Barang:</h3>";
echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr><th>Nama Barang</th><th>Harga (Rp)</th></tr>";

foreach ($hargaBarang as $barang => $harga) {
    echo "<tr>";
    echo "<td align='left'>$barang</td>";
    echo "<td align='right'>" . number_format($harga, 0, ',', '.') . "</td>";
    echo "</tr>";
}

?>
