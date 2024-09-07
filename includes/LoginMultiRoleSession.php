<?php
session_start();
include 'koneksi.php';  // Pastikan path ini benar

// Memastikan input username dan password telah diisi
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Escape input untuk mencegah SQL Injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];  // Ambil password dari input

    // Menggunakan prepared statement untuk keamanan lebih baik
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    if ($stmt === false) {
        // Jika terjadi kesalahan pada prepare statement
        error_log('mysqli prepare() failed: ' . htmlspecialchars($conn->error));
        $_SESSION['error'] = "Terjadi kesalahan sistem, silakan coba lagi nanti.";
        header("Location: LoginForm.php");
        exit();
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Memeriksa apakah data ditemukan
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verifikasi password dengan hash yang tersimpan di database
        if (password_verify($password, $row['password'])) {
            // Regenerasi session ID untuk keamanan
            session_regenerate_id(true);

            // Set session berdasarkan data pengguna
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            // Redirect berdasarkan role pengguna
            if ($row['role'] === 'admin') {
                header("Location: ../dashboard/dshb/adminDashboard.php");
            } else {
                header("Location: ../dashboard/dshb/userDashboard.php");
            }
            exit();  // Pastikan skrip berhenti setelah redirect
        } else {
            // Jika password salah
            $_SESSION['error'] = "Username atau password salah";
            header("Location: LoginForm.php");
            exit();  // Berhenti setelah redirect
        }
    } else {
        // Jika username tidak ditemukan
        $_SESSION['error'] = "Username atau password salah";
        header("Location: LoginForm.php");
        exit();  // Berhenti setelah redirect
    }

    $stmt->close();
} else {
    // Jika input tidak lengkap
    $_SESSION['error'] = "Silakan isi username dan password";
    header("Location: LoginForm.php");
    exit();  // Berhenti setelah redirect
}

$conn->close();
?>
