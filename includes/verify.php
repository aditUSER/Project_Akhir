<?php
include 'koneksi.php'; // Koneksi ke database
require __DIR__ . '/../vendor/autoload.php'; // Sertakan autoload.php untuk PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Fungsi untuk mengirim email pemberitahuan
function sendVerificationEmail($userEmail, $verificationToken) {
    $mail = new PHPMailer(true); // Buat instance PHPMailer

    try {
        // Set server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'aditmaajid2@gmail.com'; // Ganti dengan email Gmail Anda
        $mail->Password   = 'jtamwvsxsgcwyqfp'; // Ganti dengan password aplikasi Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Set penerima dan pengirim
        $mail->setFrom('noreply@sitelordmbut.my.id', 'East Project'); // Menggunakan alias email
        $mail->addAddress($userEmail); // Email penerima

        // Set format email
        $mail->isHTML(true);
        $mail->Subject = 'Verifikasi Akun Anda';
        $mail->Body    = 'Kode verifikasi Anda adalah: <b>' . $verificationToken . '</b>';
        $mail->AltBody = 'Kode verifikasi Anda adalah: ' . $verificationToken;

        // Kirim email
        $mail->send();
    } catch (Exception $e) {
        // Tampilkan pesan error jika pengiriman email gagal
        echo "Gagal mengirim email pemberitahuan. Mailer Error: {$mail->ErrorInfo}";
    }
}

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputToken = trim($_POST['token']);
    
    // Cek apakah token valid
    $stmt = $conn->prepare("SELECT * FROM users WHERE verification_token = ?");
    $stmt->bind_param('s', $inputToken);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Update status menjadi verified dan hapus token
        $update_stmt = $conn->prepare("UPDATE users SET verified = 1, verification_token = NULL WHERE verification_token = ?");
        $update_stmt->bind_param('s', $inputToken);
        $update_stmt->execute();

        // Kirim email pemberitahuan setelah verifikasi
        sendVerificationEmail($user['email'], $inputToken);

        // Arahkan pengguna ke halaman login setelah verifikasi
        header("Location: ../LoginForm.php");
        exit();
    } else {
        $error_message = "Token verifikasi tidak valid atau akun sudah diverifikasi.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/verify.css"> <!-- Tautkan file CSS verify.css -->
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Verifikasi Akun</h2>
        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="verify.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="token">Masukkan Kode Verifikasi:</label>
                <input type="text" class="form-control" id="token" name="token" required>
            </div>
            <button type="submit" class="btn btn-primary">Verifikasi</button>
        </form>
    </div>
</body>
</html>
