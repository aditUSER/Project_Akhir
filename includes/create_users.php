<?php
include 'koneksi.php';  // Pastikan path file koneksi.php benar

// Data pengguna baru
$username = 'asemwi';  // Ganti dengan username yang ingin Anda buat
$password = 'password1234';  // Ganti dengan password yang ingin Anda buat
$role = 'admin';  // Ganti dengan 'user' jika ingin membuat akun pengguna biasa

// Cek apakah username sudah ada di tabel users
$sql_check = "SELECT COUNT(*) AS count FROM users WHERE username = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();
$row_check = $result_check->fetch_assoc();

if ($row_check['count'] > 0) {
    echo "Username '$username' Username tidak dapat digunakan. Silakan gunakan username lain.";
} else {
    // Hashing password menggunakan password_hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL untuk memasukkan data ke dalam tabel users
    $sql_insert = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sss", $username, $hashedPassword, $role);

    // Jalankan query
    if ($stmt_insert->execute()) {
        echo "Akun $username berhasil dibuat!";
    } else {
        echo "Error: " . $stmt_insert->error;
    }

    $stmt_insert->close();
}

$stmt_check->close();
$conn->close();
?>
