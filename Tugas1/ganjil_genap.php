<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cek Bilangan Ganjil / Genap, dan Prima</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let angka = document.getElementById("angka").value;

            if (angka.trim() === "") {
                alert("Kolom angka tidak boleh kosong!");
                return false;
            }

            if (isNaN(angka)) {
                alert("Input harus berupa angka!");
                return false;
            }

            if (!Number.isInteger(Number(angka))) {
                alert("Harus berupa bilangan bulat, bukan desimal!");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <h2>Menentukan Bilangan Ganjil / Genap dan Prima</h2>
    <form method="POST" onsubmit="return validateForm()">
        <label for="angka">Masukkan Angka:</label>
        <input type="text" name="angka" id="angka">
        <button type="submit">Cek</button>
    </form>

    <?php
    function isPrima($n) {
        if ($n < 2) return false;
        if ($n == 2) return true;
        if ($n % 2 == 0) return false;
        for ($i = 3; $i <= sqrt($n); $i += 2) {
            if ($n % $i == 0) return false;
        }
        return true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $angka1 = trim($_POST["angka"]);

        if ($angka1 === "" || !is_numeric($angka1)) {
            echo "<p class='output' style='color:red;'>Input tidak valid, harus berupa angka!</p>";
        } elseif (strpos($angka1, ".") !== false) {
            echo "<p class='output' style='color:red;'>Harus berupa bilangan bulat, bukan desimal!</p>";
        } else {
            $angka1 = (int)$angka1;

            $jenis = ($angka1 % 2 == 0) ? "Genap" : "Ganjil";

            $prima = isPrima($angka1) ? "Prima" : "Bukan Prima";

            echo "<p class='output'><b>$angka1</b> adalah bilangan <b>$jenis</b> dan <b>$prima</b></p>";
        }
    }
    ?>
</body>
</html>
