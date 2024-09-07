<?php
session_start();
include '../includes/koneksi.php'; // Include koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $identity_card = $_FILES['identity-card']['name'];
    $driver_license = $_FILES['driver-license']['name'];
    $emergency_contact_name = mysqli_real_escape_string($conn, $_POST['emergency-contact-name']);
    $emergency_contact_phone = mysqli_real_escape_string($conn, $_POST['emergency-contact-phone']);
    $relation = mysqli_real_escape_string($conn, $_POST['relation']);

    // Tentukan direktori untuk menyimpan file yang diupload
    $target_dir = "../uploads/";
    $identity_card_target = $target_dir . basename($identity_card);
    $driver_license_target = $target_dir . basename($driver_license);

    // Proses upload file
    if (move_uploaded_file($_FILES['identity-card']['tmp_name'], $identity_card_target) && move_uploaded_file($_FILES['driver-license']['tmp_name'], $driver_license_target)) {
        // Jika file berhasil diupload, masukkan data ke database
        $sql = "INSERT INTO booking_data (identity_card, driver_license, emergency_contact_name, emergency_contact_phone, relation)
                VALUES ('$identity_card', '$driver_license', '$emergency_contact_name', '$emergency_contact_phone', '$relation')";

        if (mysqli_query($conn, $sql)) {
            // Set session variable for notification
            $_SESSION['notification'] = "Thank you for your registration";
            // Redirect to the home page with notification
            header("Location: ../index.html#section-1");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Gagal mengupload file.";
    }

    // Tutup koneksi
    mysqli_close($conn);
}
?>
