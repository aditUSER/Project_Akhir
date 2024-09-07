<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipe Kendaraan</title>
</head>
<body>

<h2>Pilih Tipe Kendaraan</h2>

<form method="post" action="process_selection.php">
    <label for="vehicle-type">Tipe Kendaraan:</label>
    <select id="vehicle-type" name="vehicle_type">
        <option value="">Pilih Tipe Kendaraan</option>
        <?php
        // Memasukkan file koneksi
        include 'koneksi.php';

        // Mengambil data dari tabel motor_brands
        $sql = "SELECT id, brand_name FROM motor_brands";
        $result = $conn->query($sql);

        // Menampilkan opsi dropdown
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['brand_name'] . "</option>";
            }
        } else {
            echo "<option value=''>Tidak ada data</option>";
        }

        // Menutup koneksi
        $conn->close();
        ?>
    </select>
    <br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
