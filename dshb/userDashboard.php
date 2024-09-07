<?php
session_start();
include '../functions/function_user.php'; // Mengakses function_user.php dari folder functions

// Mengambil data pengguna dari session atau menetapkan nilai default
$userInfo = isset($_SESSION['userInfo']) ? $_SESSION['userInfo'] : null;
$ipAddress = isset($_SESSION['ip_address']) ? $_SESSION['ip_address'] : 'Unknown';
$lastLoginTime = isset($_SESSION['last_login']) ? $_SESSION['last_login'] : 'Unknown';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/userdashboard.css"> <!-- Mengakses file CSS eksternal -->
</head>
<body>
    <div class="container dashboard-container">
        <!-- Navigation Tabs -->
        <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="--bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-5" id="home-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-5" id="profile-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-5" id="booking-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Booking</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-5" id="contact-tab2" data-bs-toggle="tab" type="button" role="tab" aria-selected="false">Contact</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Home Tab -->
            <div class="tab-pane fade show active" id="home-tab2" role="tabpanel" aria-labelledby="home-tab2">
                <div class="card">
                    <h1 class="card-title">Selamat datang, <?php echo htmlspecialchars($userInfo['username'] ?? 'Guest'); ?>!</h1>
                    <p class="card-text">Alamat IP Anda: <?php echo htmlspecialchars($ipAddress); ?></p>
                    <p class="card-text">Waktu Login Terakhir: <?php echo htmlspecialchars($lastLoginTime); ?></p>
                </div>
            </div>

            <!-- Profile Tab -->
            <div class="tab-pane fade" id="profile-tab2" role="tabpanel" aria-labelledby="profile-tab2">
                <div class="card">
                    <h2 class="card-title">Informasi Pribadi</h2>
                    <p class="card-text"><strong>Username:</strong> <?php echo htmlspecialchars($userInfo['username'] ?? 'N/A'); ?></p>
                    <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($userInfo['email'] ?? 'N/A'); ?></p>
                    <p class="card-text"><strong>Phone:</strong> <?php echo htmlspecialchars($userInfo['phone'] ?? 'N/A'); ?></p>
                    <p class="card-text"><strong>Registration Date:</strong> <?php echo htmlspecialchars($userInfo['registration_date'] ?? 'N/A'); ?></p>
                </div>
            </div>

            <!-- Booking Tab -->
            <div class="tab-pane fade" id="booking-tab2" role="tabpanel" aria-labelledby="booking-tab2">
                <div class="card">
                    <h2 class="card-title">Pesan Sepeda</h2>
                    <!-- Form pemesanan -->
                    <form action="../booking/bookingProcess.php" method="POST"> <!-- Mengakses bookingProcess.php dari folder booking -->
                        <div class="form-group">
                            <label for="bike">Pilih Sepeda:</label>
                            <select class="form-control" id="bike" name="bike">
                                <!-- Ganti dengan data sepeda dari database -->
                                <option value="bike1">Sepeda 1</option>
                                <option value="bike2">Sepeda 2</option>
                                <option value="bike3">Sepeda 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rental-date">Tanggal Penyewaan:</label>
                            <input type="date" class="form-control" id="rental-date" name="rental_date" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Pesan</button>
                    </form>
                </div>
            </div>

            <!-- Contact Tab -->
            <div class="tab-pane fade" id="contact-tab2" role="tabpanel" aria-labelledby="contact-tab2">
                <div class="card">
                    <h2 class="card-title">Hubungi Customer Service</h2>
                    <p>Anda dapat menghubungi customer service kami melalui:</p>
                    <ul>
                        <li>Email: support@yourwebsite.com</li>
                        <li>Telepon: (123) 456-7890</li>
                    </ul>
                </div>
            </div>
        </div>

        <a href="../includes/sessionLogout.php" class="btn btn-primary logout-btn">Logout</a>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
