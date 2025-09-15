<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let angka1 = document.forms["calcForm"]["angka1"].value.trim();
            let angka2 = document.forms["calcForm"]["angka2"].value.trim();
            let operator = document.forms["calcForm"]["operator"].value;

            // cek angka1 kosong atau bukan angka
            if (angka1.trim() === "" || isNaN(angka1)) {
                alert("Angka 1 harus diisi dan berupa angka!");
                return false;
            }


            // cek angka2 kosong atau bukan angka
            if (angka2.trim() === "" || isNaN(angka2)) {
                alert("Angka 2 harus diisi dan berupa angka!");
                return false;
            }

            // cek pembagian dengan nol
            if (operator === "/" && Number(angka2) === 0) {
                alert("Angka 2 tidak boleh 0 untuk pembagian!");
                return false;
            }

            return true; // semua valid
        }
    </script>
</head>
<body>
    <h1>Kalkulator Sederhana</h1>
    <form name="calcForm" method="POST" onsubmit="return validateForm()">
        <label>Angka 1:</label>
        <input type="text" name="angka1"><br><br>

        <label>Angka 2:</label>
        <input type="text" name="angka2"><br><br>

        <label>Operator:</label>
        <select name="operator">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select><br><br>

        <button type="submit">Hitung</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $angka1 = $_POST['angka1'];
        $angka2 = $_POST['angka2'];
        $operator = $_POST['operator'];

        switch ($operator) {
            case '+':
                echo "<h2>Hasil: " . ($angka1 + $angka2) . "</h2>";
                break;
            case '-':
                echo "<h2>Hasil: " . ($angka1 - $angka2) . "</h2>";
                break;
            case '*':
                echo "<h2>Hasil: " . ($angka1 * $angka2) . "</h2>";
                break;
            case '/':
                if ($angka2 != 0) {
                    echo "<h2>Hasil: " . ($angka1 / $angka2) . "</h2>";
                } else {
                    echo "<h2>Error: Tidak bisa dibagi 0!</h2>";
                }
                break;
            default:
                echo "<h2>Operator tidak dikenal</h2>";
                break;
        }
    }
    ?>
</body>
</html>
