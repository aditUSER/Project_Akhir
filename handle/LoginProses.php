<?php
// Menghubungkan ke database
include 'includes/koneksi.php';

// Fungsi untuk membersihkan input dan mencegah XSS
function clean_input($data) {
    return htmlspecialchars(trim($data));
}

// Cek apakah form login telah di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil dan membersihkan data dari form login
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);

    // Validasi input agar tidak kosong
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan Password tidak boleh kosong!";
        header("Location: ../LoginForm.php");
        exit();
    }

    // Menggunakan prepared statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah pengguna ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Jika password cocok, set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['loggedin'] = true;

            // Regenerasi session ID untuk keamanan
            session_regenerate_id(true);

            // Redirect berdasarkan peran pengguna
            if ($user['role'] == 'admin') {
                header("Location: ../dashboard/dshb/adminDashboard.php");
            } elseif ($user['role'] == 'user') {
                header("Location: ../dashboard/dshb/userDashboard.php");
            }
            exit();
        } else {
            // Jika password salah
            $_SESSION['error'] = "Password salah!";
            header("Location: ../LoginForm.php");
            exit();
        }
    } else {
        // Jika username tidak ditemukan
        $_SESSION['error'] = "Username tidak ditemukan!";
        header("Location: ../LoginForm.php");
        exit();
    }

    // Menutup statement
    $stmt->close();
} else {
    // Jika form tidak diakses dengan metode POST
    $_SESSION['error'] = "Metode tidak valid!";
    header("Location: ../LoginForm.php");
    exit();
}

// Menutup koneksi
$conn->close();
?>
