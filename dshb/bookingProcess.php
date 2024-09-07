<?php
// bookingProcess.php

session_start();

// Pastikan pengguna terautentikasi
if ($_SESSION['role'] != 'user') {
    header("Location: ../LoginForm.php");
    exit();
}

// Validasi dan proses data pemesanan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bike = $_POST['bike'];
    $rentalDate = $_POST['rental_date'];
    
    // Simpan data pemesanan ke database atau lakukan tindakan yang diperlukan
    // Contoh: Simpan ke database
    
    // Redirect ke halaman konfirmasi atau kembali ke dashboard
    header("Location: userDashboard.php");
    exit();
}
?>
