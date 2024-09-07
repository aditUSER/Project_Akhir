<?php
$servername = 'localhost';  // Alamat server MySQL (default port 3306)
$user = 'root';             // Username MySQL
$pass = '';                 // Password MySQL (kosong jika tidak ada password)
$db   = 'tsa_web';          // Nama database yang digunakan

// Membuat koneksi ke database
$conn = new mysqli($servername, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
