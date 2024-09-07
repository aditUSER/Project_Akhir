<?php
session_start();
include 'koneksi.php'; // Include koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure session data is available
    if (!isset($_SESSION['client_name']) || !isset($_POST['start_time']) || !isset($_FILES['identity_card'])) {
        echo "Data tidak lengkap. Mohon isi semua data yang diperlukan.";
        exit();
    }

    // Retrieve data from session
    $client_name = $_SESSION['client_name'];
    $client_address = $_SESSION['client_address'];
    $client_region = $_SESSION['client_region'];
    $client_city = $_SESSION['client_city'];
    $client_phone = $_SESSION['client_phone'];
    $client_email = $_SESSION['client_email'];
    $client_postal_code = $_SESSION['client_postal_code']; 
    $emergency_contact_name = $_SESSION['emergency_contact_name']; 
    $emergency_contact_phone = $_SESSION['emergency_contact_phone']; 

    // Retrieve date data from the form
    $start_time = $_POST['start_time']; 
    $end_time = $_POST['end_time']; 

    // Validate uploaded files (identity card and driver license)
    if ($_FILES['identity_card']['error'] == 0 && $_FILES['driver_license']['error'] == 0) {
        $identity_card = $_FILES['identity_card']['name'];
        $driver_license = $_FILES['driver_license']['name'];

        // Specify the upload directory
        $target_dir = "../uploads/";
        $identity_card_path = $target_dir . basename($identity_card);
        $driver_license_path = $target_dir . basename($driver_license);

        // Move files to the target directory
        if (move_uploaded_file($_FILES["identity_card"]["tmp_name"], $identity_card_path) && 
            move_uploaded_file($_FILES["driver_license"]["tmp_name"], $driver_license_path)) {

            // Sanitize user input (replace with your preferred sanitization method)
            $client_name = mysqli_real_escape_string($conn, $client_name);
            $client_address = mysqli_real_escape_string($conn, $client_address);
            // ... sanitize other variables similarly

            // Insert data into the database
            $sql = "INSERT INTO bookings (client_name, client_address, client_region, client_city, client_phone, client_postal_code, client_email, start_time, end_time, emergency_contact_name, emergency_contact_phone, identity_card, driver_license)
                    VALUES ('$client_name', '$client_address', '$client_region', '$client_city', '$client_phone', '$client_postal_code', '$client_email', '$start_time', '$end_time', '$emergency_contact_name', '$emergency_contact_phone', '$identity_card', '$driver_license')";

            if ($conn->query($sql) === TRUE) {
                echo "Data berhasil disimpan.";
                // Optionally, redirect to a success page or display a success message
                // header("Location: success.php"); 
                // exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "Error dalam pengunggahan file.";
    }

    $conn->close();
}
?>