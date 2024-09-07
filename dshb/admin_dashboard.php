<?php
session_start();
include '../includes/koneksi.php'; // Include koneksi database

// Pastikan admin yang login bisa melihat halaman ini
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - File Uploads</title>
    <link rel="stylesheet" href="../css/Index.css"> <!-- Optional CSS for admin styling -->
</head>
<body>
    <h1>List of Uploaded Files</h1>

    <?php
    // Ambil data file dari database
    $sql = "SELECT identity_card, driver_license FROM booking_data2";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>
        <tr>
            <th>Identity Card</th>
            <th>Driver License</th>
            <th>Actions</th>
        </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><a href='../uploads/" . $row['identity_card'] . "' target='_blank'>" . $row['identity_card'] . "</a></td>";
            echo "<td><a href='../uploads/" . $row['driver_license'] . "' target='_blank'>" . $row['driver_license'] . "</a></td>";
            echo "<td><a href='../uploads/" . $row['identity_card'] . "' download>Download Identity Card</a> | 
                      <a href='../uploads/" . $row['driver_license'] . "' download>Download Driver License</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No uploaded files found.</p>";
    }
    
    // Cek apakah admin sudah login
    if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php'); // Redirect ke halaman login jika belum login
    exit();
    }
    // Tutup koneksi
    mysqli_close($conn);
    ?>
</body>
</html>
