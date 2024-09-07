<?php
include 'includes/koneksi.php'; // Pastikan file koneksi database sudah ada

$error_message = '';

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$rememberMe = isset($_POST['rememberMe']);

// Validasi server-side
if (empty($username)) {
    $error_message = "Username tidak boleh kosong.";
} elseif (empty($password)) {
    $error_message = "Password tidak boleh kosong.";
} else {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        if ($user['verified'] == 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($rememberMe) {
                setcookie('username', $username, time() + (86400 * 30), "/");
            }

            if ($user['role'] === 'admin') {
                header("Location: ../dashboard/dshb/adminDashboard.php");
            } else {
                header("Location: ../dashboard/dshb/userDashboard.php");
            }
            exit();
        } else {
            $error_message = "Akun Anda belum diverifikasi. Silakan periksa email atau nomor telepon Anda.";
        }
    } else {
        $error_message = "Username atau Password salah.";
    }
}

// Tutup koneksi
mysqli_close($conn);
?>
