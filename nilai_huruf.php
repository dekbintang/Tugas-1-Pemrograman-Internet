<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menentukan Nilai Huruf</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let nilai = document.getElementById("nilai").value.trim();

            if (nilai === "") {
                alert("Tidak boleh kosong! Silakan masukkan nilai.");
                return false;
            } 
            else if (isNaN(nilai)) {
                alert("Input harus berupa angka!");
                return false;
            } 
            else if (nilai < 0 || nilai > 100) {
                alert("Nilai harus berada di antara 0 sampai 100!");
                return false;
            }

            return true; 
        }
    </script>
</head>
<body>
    <h2>Menentukan Nilai Huruf</h2>
    <form method="post" onsubmit="return validateForm()">
        <label for="nilai">Masukkan Nilai (0–100): </label>
        <input type="text" name="nilai" id="nilai">
        <button type="submit">Cek</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nilai = trim($_POST["nilai"]);

        if ($nilai === "" || !is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
            echo "<p class='output' style='color:red;'>Input tidak valid!</p>";
        } else {
            if ($nilai >= 85) {
                $grade = "A";
            } elseif ($nilai >= 70) {
                $grade = "B";
            } elseif ($nilai >= 55) {
                $grade = "C";
            } elseif ($nilai >= 40) {
                $grade = "D";
            } else {
                $grade = "E";
            }

            echo "<p class='output'>Grade: <span class='grade'>$grade</span></p>";
        }
    }
    ?>
</body>
</html>
