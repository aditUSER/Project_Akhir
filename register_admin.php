<?php
session_start();
include 'functions/function_admin.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $error_message = validatePassword($password, $confirm_password);
    if (!$error_message) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if (registerAdmin($username, $email, $hashedPassword)) {
            echo "<script>alert('Admin berhasil didaftarkan!');</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat mendaftarkan admin.');</script>";
        }
    } else {
        echo "<script>alert('$error_message');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/register_admin.css">
</head>
<body>
    <div class="container">
        <div class="register-container shadow p-5 rounded bg-white animated fadeInDown">
            <h2 class="text-center mb-4">Registrasi Admin</h2>
            <form action="registrasi-admin.php" method="POST" novalidate>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <small id="passwordHelp" class="form-text text-muted">Password harus memiliki panjang minimal 8 karakter, mengandung huruf besar, kecil, angka, dan simbol.</small>
                    <div id="password-strength" class="password-strength mt-2"></div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Daftar</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JS for Password Strength -->
    <script>
        const password = document.getElementById('password');
        const passwordStrength = document.getElementById('password-strength');

        function checkPasswordStrength(val) {
            let strength = 'Weak';
            let strengthClass = 'weak';
            
            // Regular expressions to test password strength
            const lengthCheck = val.length >= 8;
            const upperCheck = /[A-Z]/.test(val);
            const lowerCheck = /[a-z]/.test(val);
            const numberCheck = /[0-9]/.test(val);
            const symbolCheck = /[!@#$%^&*()_+{}\[\]:;"'<>,.?~\\/-]/.test(val);

            if (lengthCheck && upperCheck && lowerCheck && numberCheck && symbolCheck) {
                strength = 'Strong';
                strengthClass = 'strong';
            } else if (lengthCheck && (upperCheck || lowerCheck) && (numberCheck || symbolCheck)) {
                strength = 'Moderate';
                strengthClass = 'moderate';
            }

            return { strength, strengthClass };
        }

        password.addEventListener('input', function () {
            const val = password.value;
            const { strength, strengthClass } = checkPasswordStrength(val);
            
            passwordStrength.textContent = 'Strength: ' + strength;
            passwordStrength.className = 'password-strength ' + strengthClass;
        });
    </script>
</body>
</html>
