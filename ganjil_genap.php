<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Ganjil / Genap</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let angka = document.getElementById("angka").value;

            // cek kosong atau spasi saja
            if (angka.trim() === "") {
                alert("Kolom angka tidak boleh kosong!");
                return false;
            }

            // cek bukan angka
            if (isNaN(angka)) {
                alert("Input harus berupa angka!");
                return false;
            }

            // cek bilangan bulat
            if (!Number.isInteger(Number(angka))) {
                alert("Harus berupa bilangan bulat, bukan desimal!");
                return false;
            }

            return true; // jika valid, form boleh dikirim
        }
    </script>
</head>
<body>
    <h2>Menentukan Bilangan Ganjil / Genap</h2>
    <form method="POST" onsubmit="return validateForm()">
        <label for="angka">Masukkan Angka:</label>
        <input type="text" name="angka" id="angka">
        <button type="submit">Cek</button>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $angka1 = trim($_POST["angka"]); // hapus spasi depan-belakang

    if ($angka1 === "" || !is_numeric($angka1)) {
        echo "<p class='output' style='color:red;'>Input tidak valid, harus berupa angka!</p>";
    } elseif (strpos($angka1, ".") !== false) {
        echo "<p class='output' style='color:red;'>Harus berupa bilangan bulat, bukan desimal!</p>";
    } else {
        if ($angka1 % 2 == 0) {
            echo "<p class='output'><b>$angka1</b> adalah bilangan <b>Genap</b></p>";
        } else {
            echo "<p class='output'><b>$angka1</b> adalah bilangan <b>Ganjil</b></p>";
        }
    }
}
?>
</body>
</html>
