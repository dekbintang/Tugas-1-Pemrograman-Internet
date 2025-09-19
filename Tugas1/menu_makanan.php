<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu Makanan</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let menu = document.getElementById("menu").value;
            if (menu === "") {
                alert("Silakan pilih menu makanan!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h2>Menu Makanan</h2>
    <form method="POST" onsubmit="return validateForm()">
        <label for="menu">Pilih Menu:</label>
        <select name="menu" id="menu">
            <option value="">Pilih Makanan</option>
            <option value="nasi_goreng">Nasi Goreng</option>
            <option value="bakso">Bakso</option>
            <option value="mie_ayam">Mie Ayam</option>
        </select>
        <br><br>
        <button type="submit">Lihat Harga</button>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu = $_POST["menu"];

    switch ($menu) {
        case "nasi_goreng":
            echo "<p class='output'>Harga <b>Nasi Goreng</b> adalah <b>Rp15.000</b></p>";
            break;

        case "bakso":
            echo "<p class='output'>Harga <b>Bakso</b> adalah <b>Rp12.000</b></p>";
            break;

        case "mie_ayam":
            echo "<p class='output'>Harga <b>Mie Ayam</b> adalah <b>Rp25.000</b></p>";
            break;

        default:
            echo "<p class='output' style='color:red;'>Silakan pilih menu terlebih dahulu!</p>";
            break;
    }
}
?>

</body>
</html>
