<?php
// Menampilkan semua error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Menghancurkan session
session_destroy();

// Pastikan session sudah dihancurkan
if (session_status() !== PHP_SESSION_NONE) {
    // Jika sesi tidak berhasil dihancurkan, tulis pesan kesalahan di log
    error_log("Session gagal dihancurkan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .message {
            font-size: 24px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="message">
        Terima kasih telah berkunjung
    </div>
    <script>
        setTimeout(function(){
            window.location.href = '../LoginForm.php'; // Mengarahkan ke halaman login setelah 5 detik
        }, 5000);
    </script>
</body>
</html>
