<?php
$result = "";

if (isset($_POST['submit'])) {
    $n1 = (int) $_POST['n1'];
    $n2 = (int) $_POST['n2'];

    if ($n1 < $n2) {
        $genap = [];
        for ($i = $n1; $i <= $n2; $i++) {
            if ($i % 2 == 0) {
                $genap[] = $i;
            }
        }

        if (!empty($genap)) {
            $result .= "<h3>Bilangan Genap dari $n1 sampai $n2:</h3>";
            $result .= "<table border='1' cellpadding='8' cellspacing='0'>";
            $result .= "<tr><th>No</th><th>Bilangan</th></tr>";

            $no = 1;
            foreach ($genap as $g) {
                $result .= "<tr><td align='center'>$no</td><td align='center'>$g</td></tr>";
                $no++;
            }
            $result .= "</table>";
        } else {
            $result .= "<p style='color:orange;'>Tidak ada bilangan genap pada rentang tersebut.</p>";
        }
    } else {
        $result .= "<p style='color:red;'>Syarat: n1 harus lebih kecil dari n2!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tampilkan Bilangan Genap</title>
</head>
<body>
    <h2>Menampilkan Bilangan Genap</h2>
    <form method="post">
        <label>Nilai 1: <input type="number" name="n1" required></label><br><br>
        <label>Nilai 2: <input type="number" name="n2" required></label><br><br>
        <input type="submit" name="submit" value="Tampilkan">
    </form>

    <br>
    <?php echo $result; ?>
</body>
</html>
