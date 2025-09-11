<!DOCTYPE html>
<html>
<head>
    <title>Form Input</title>
</head>
<body>
    <form method="POST">
        <h1>Form Ucapan</h1>
        <label>Nama:</label>
        <input type="text" name="nama" required>
        <button type="submit">Kirim</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = htmlspecialchars($_POST["nama"]);
        echo "Halo, $nama selamat belajar PHP!";
    }
    ?>
</body>
</html>
