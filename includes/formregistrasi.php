<?php
include 'koneksi.php'; // Koneksi ke database
require __DIR__ . '/../vendor/autoload.php'; // Sertakan autoload.php untuk PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Aktifkan pelaporan error MySQLi untuk debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Membersihkan input dari spasi
    $username = trim(preg_replace('/\s+/', '', $_POST['username']));
    $email = trim(preg_replace('/\s+/', '', $_POST['email']));
    $phone = trim(preg_replace('/\s+/', '', $_POST['phone']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        $error_message = "Semua kolom harus diisi.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Password dan konfirmasi password tidak cocok.";
    } else {
        try {
            // Cek apakah username, email, atau phone sudah ada
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ? OR phone = ?");
            $stmt->bind_param('sss', $username, $email, $phone);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error_message = "Username, email, atau nomor telepon sudah digunakan.";
            } else {
                // Hash password
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Buat token verifikasi 6 digit
                $verification_token = sprintf("%06d", rand(0, 999999)); // Token 6 digit

                // Simpan data ke database dengan role default 'user'
                $stmt = $conn->prepare("INSERT INTO users (username, email, phone, password, verification_token, role) VALUES (?, ?, ?, ?, ?, 'user')");
                $stmt->bind_param('sssss', $username, $email, $phone, $hashedPassword, $verification_token);

                if ($stmt->execute()) {
                    // Kirim email dengan token verifikasi menggunakan PHPMailer
                    $mail = new PHPMailer(true);
                    try {
                        // Set server settings
                        $mail->isSMTP(); // Set mailer untuk gunakan SMTP
                        $mail->Host       = 'smtp.gmail.com'; // Server SMTP Gmail
                        $mail->SMTPAuth   = true; // Aktifkan otentikasi SMTP
                        $mail->Username   = 'aditmaajid2@gmail.com'; // Ganti dengan email Gmail Anda
                        $mail->Password   = 'jtamwvsxsgcwyqfp'; // Ganti dengan password aplikasi Anda
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Gunakan TLS
                        $mail->Port       = 587; // Port untuk TLS

                        // Set recipients
                        $mail->setFrom('no-reply@sitelordmbut.my.id', 'East Project');
                        $mail->addAddress($email);

                        // Set email format
                        $mail->isHTML(true);
                        $mail->Subject = 'Verifikasi Akun Anda';
                        $mail->Body    = "Gunakan token berikut untuk memverifikasi akun Anda: <b>$verification_token</b>";
                        $mail->AltBody = "Gunakan token berikut untuk memverifikasi akun Anda: $verification_token";

                        $mail->send();
                        header("Location: verify.php");
                        exit();
                    } catch (Exception $e) {
                        $error_message = "Gagal mengirim email verifikasi. Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $error_message = "Terjadi kesalahan. Silakan coba lagi.";
                }
            }

            $stmt->close();
        } catch (Exception $e) {
            $error_message = "Error: " . $e->getMessage();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/body_fr.css" rel="stylesheet"> <!-- Tautkan file CSS eksternal -->
</head>
<body>
    <div class="container">
        <h2 class="text-center">Registrasi</h2>
        <?php if (!empty($error_message)) : ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="../includes/formregistrasi.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Nomor Telepon:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>
    </div>
</body>
</html>
