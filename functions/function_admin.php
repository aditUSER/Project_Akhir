<?php
function registerAdmin($username, $email, $password) {
    include 'includes/koneksi.php'; // Sesuaikan dengan file koneksi Anda

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->bind_param('sss', $username, $email, $password);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function validatePassword($password, $confirm_password) {
    if ($password !== $confirm_password) {
        return "Password tidak sesuai dengan konfirmasi.";
    }
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[a-z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[!@#$%^&*()_+{}\[\]:;\"'<>,.?~\\/-]/", $password)) {
        return "Password harus memiliki panjang minimal 8 karakter, mengandung huruf besar, kecil, angka, dan simbol.";
    }
    return null;
}
?>
