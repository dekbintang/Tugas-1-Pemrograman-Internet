<!DOCTYPE html>
<html>
<head>
    <title>Form Input</title>
    <link rel="stylesheet" href="style.css">
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
        echo "<div class='output'>Halo, <b>$nama</b> selamat belajar PHP!</div>";
    }
    ?>
</body>
</html>
