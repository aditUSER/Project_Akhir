<?php
// Sertakan file koneksi
include 'koneksi.php'; // Pastikan nama file sesuai dengan file koneksi Anda

// Query untuk mendapatkan data jenis kendaraan
$sql = "SELECT id, brand_name FROM motor_brands"; // Periksa nama tabel dan kolom
$result = $conn->query($sql);

// Mulai HTML untuk dropdown
echo '<select name="type_vehicle" id="type_vehicle">';

// Periksa jika ada hasil
if ($result->num_rows > 0) {
    // Output data dari setiap baris
    while($row = $result->fetch_assoc()) {
        // Buat elemen <option> untuk setiap baris data
        echo '<option value="' . $row['id'] . '">' . $row['brand_name'] . '</option>';
    }
} else {
    // Jika tidak ada data, tampilkan opsi default
    echo '<option value="">No types available</option>';
}

// Akhiri HTML untuk dropdown
echo '</select>';

// Tutup koneksi
$conn->close();
?>
