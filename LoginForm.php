<?php
session_start();
$error_message = '';

// Include handler jika form dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'handle/login_handler.php';
}
// Include handler jika form dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'handle/LoginProses.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form with Session</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css"> <!-- CSS untuk styling -->
</head>
<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error_message)) : ?>
                            <div class="alert alert-danger text-center"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                                <div id="usernameError" class="error-message"></div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                                <div id="passwordError" class="error-message"></div>
                            </div>
                            <div class="form-group checkbox-inline">
                                <div class="remember-me">
                                    <input type="checkbox" id="rememberMe" name="rememberMe">
                                    <label for="rememberMe" class="ml-2">Remember me</label>
                                </div>
                                <a href="#" class="custom-link" onclick="showNotification()">Forgot password?</a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" id="loginButton">Login</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Don't have an account? <a href="includes/formregistrasi.php" class="custom-link">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="notification" class="notification">
        Perintah tidak dapat terlaksana
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/login.js"></script> <!-- JavaScript untuk validasi dan notifikasi -->
</body>
</html>
