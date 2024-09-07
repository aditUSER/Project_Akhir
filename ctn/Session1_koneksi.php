<?php
session_start();
include '../includes/koneksi.php'; // Include koneksi database

// Jika formulir dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan sanitasi data dari formulir Booking.php
    $client_name = mysqli_real_escape_string($conn, $_POST['client-name']);
    $client_email = mysqli_real_escape_string($conn, $_POST['client-email']);
    $client_address = mysqli_real_escape_string($conn, $_POST['client-address']);
    $client_region = mysqli_real_escape_string($conn, $_POST['client-region']);
    $client_city = mysqli_real_escape_string($conn, $_POST['client-city']);
    $country_code = mysqli_real_escape_string($conn, $_POST['country-code']);
    $client_phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $client_postal_code = mysqli_real_escape_string($conn, $_POST['client-postal-code']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product-name']);
    $start_time = mysqli_real_escape_string($conn, $_POST['start-time']);
    $end_time = mysqli_real_escape_string($conn, $_POST['end-time']);
    $number_of_order = mysqli_real_escape_string($conn, $_POST['number-of-order']);
    $special_request = mysqli_real_escape_string($conn, $_POST['special-request']);

    // Gabungkan kode negara dan nomor telepon
    $full_phone_number = $country_code . $client_phone;

    // Buat query insert ke database
    $sql = "INSERT INTO booking_data (client_name, client_email, client_address, client_region, client_city, client_phone, client_postal_code, product_name, start_time, end_time, number_of_order, special_request)
            VALUES ('$client_name', '$client_email', '$client_address', '$client_region', '$client_city', '$full_phone_number', '$client_postal_code', '$product_name', '$start_time', '$end_time', '$number_of_order', '$special_request')";

    // Eksekusi query
    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil disimpan.";
        // Redirect ke halaman kedua (session 2)
        header("Location: Session2_Booking.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Tutup koneksi
    mysqli_close($conn);
}
?>
