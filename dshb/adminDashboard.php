<?php
session_start();

// Cek apakah pengguna sudah login dan memiliki role admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: LoginForm.php");
    exit();
}

// Menyimpan waktu login terakhir ke dalam sesi (ini bisa disimpan di database jika dibutuhkan)
if (!isset($_SESSION['last_login'])) {
    $_SESSION['last_login'] = date("Y-m-d H:i:s");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for Styling -->
    <style>
        body {
            background-image: url('ppbc.jpg');
            background-size: cover;
            background-position: center;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }
        .dashboard-container {
            margin-top: 50px;
        }
        .card {
            background-color: rgba(0, 0, 51, 0.8); /* Biru gelap dengan transparansi */
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .card-header {
            background-color: rgba(0, 51, 102, 0.9); /* Biru yang lebih terang */
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            text-align: center;
            padding: 20px;
        }
        .card-footer {
            background-color: rgba(0, 51, 102, 0.9); /* Warna footer yang sama dengan header */
            color: white;
            border-radius: 0 0 15px 15px;
            text-align: center;
        }
        .digital-clock {
            font-size: 36px;
            font-weight: bold;
            color: #00ffff; /* Warna neon biru muda */
            margin-bottom: 20px;
        }
        .last-login {
            font-size: 18px;
            margin-top: 20px;
            color: #d1d1d1; /* Warna abu-abu muda */
        }
        .btn-logout {
            background-color: #ff5733; /* Warna oranye terang */
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            background-color: #c70039; /* Warna merah gelap */
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Admin Dashboard</h2>
                    </div>
                    <div class="card-body">
                        <p class="digital-clock" id="digitalClock"></p>
                        <p>Selamat datang, <strong><?php echo $_SESSION['username']; ?></strong></p>
                        <p class="last-login">Waktu login terakhir: <?php echo $_SESSION['last_login']; ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="../includes/sessionLogout.php" class="btn btn-logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk menampilkan jam digital -->
    <script>
        function updateClock() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            // Tambahkan 0 di depan angka jika kurang dari 10
            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            var currentTime = hours + ':' + minutes + ':' + seconds;
            document.getElementById('digitalClock').textContent = currentTime;
        }

        // Perbarui jam setiap detik
        setInterval(updateClock, 1000);

        // Jalankan fungsi untuk menampilkan jam pada saat halaman dimuat
        updateClock();
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
