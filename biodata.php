<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Biodata Singkat</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            let nama = document.getElementById("nama").value.trim();
            let umur = document.getElementById("umur").value.trim();
            let jenisKelamin = document.getElementById("jenis_kelamin").value;
            let alamat = document.getElementById("alamat").value.trim();

            // Validasi Nama: tidak kosong dan hanya huruf/spasi
            if (nama === "") {
                alert("Nama harus diisi!");
                return false;
            }
            let namaRegex = /^[a-zA-Z\s]+$/;
            if (!namaRegex.test(nama)) {
                alert("Nama hanya boleh mengandung huruf dan spasi!");
                return false;
            }

            // Validasi Umur: tidak kosong dan bilangan bulat positif
            if (umur === "") {
                alert("Umur harus diisi!");
                return false;
            }
            if (!/^\d+$/.test(umur)) {
                alert("Umur harus berupa bilangan bulat positif!");
                return false;
            }

            // Validasi Jenis Kelamin
            if (jenisKelamin === "") {
                alert("Pilih jenis kelamin!");
                return false;
            }

            // Validasi Alamat
            if (alamat === "") {
                alert("Alamat harus diisi!");
                return false;
            }

            return true; // semua valid
        }
    </script>
</head>
<body>
    <h2>Form Biodata Singkat</h2>
    <form method="POST" onsubmit="return validateForm()">
        <label for="nama">Nama:</label><br>
        <input type="text" name="nama" id="nama"><br><br>

        <label for="umur">Umur:</label><br>
        <input type="text" name="umur" id="umur"><br><br>

        <label for="jenis_kelamin">Jenis Kelamin:</label><br>
        <select name="jenis_kelamin" id="jenis_kelamin">
            <option value="">--Pilih Jenis Kelamin--</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br><br>

        <label for="alamat">Alamat:</label><br>
        <textarea name="alamat" id="alamat" rows="3" cols="40"></textarea><br><br>

        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = trim($_POST["nama"]);
        $umur = trim($_POST["umur"]);
        $jenisKelamin = $_POST["jenis_kelamin"] ?? "";
        $alamat = trim($_POST["alamat"]);

        // Validasi tambahan di PHP
        if ($nama === "" || !preg_match("/^[a-zA-Z\s]+$/", $nama) ||
            $umur === "" || !ctype_digit($umur) ||
            $jenisKelamin === "" || $alamat === "") {
            echo "<p class='output' style='color:red;'>Data tidak valid. Pastikan semua kolom diisi dengan benar.</p>";
        } else {
            echo "<p class='output'>Halo, nama saya <b>$nama</b>. Umur saya <b>$umur</b> tahun. ";
            echo "Saya seorang <b>$jenisKelamin</b>. Saya tinggal di <b>$alamat</b>.</p>";
        }
    }
    ?>
</body>
</html>
