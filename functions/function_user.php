<?php
// function.php

// Include koneksi database
include '../includes/koneksi.php';

/**
 * Mengambil informasi pengguna berdasarkan username
 *
 * @param mysqli $conn Koneksi database
 * @param string $username Username pengguna
 * @return array|null Data pengguna atau null jika tidak ditemukan
 */
function getUserInfo($conn, $username) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

/**
 * Memesan sepeda
 *
 * @param mysqli $conn Koneksi database
 * @param string $username Username pengguna
 * @param int $bikeId ID sepeda
 * @param string $bookingDate Tanggal pemesanan
 * @return bool True jika berhasil, false jika gagal
 */
function bookBike($conn, $username, $bikeId, $bookingDate) {
    $stmt = $conn->prepare("INSERT INTO bookings (username, bike_id, booking_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $username, $bikeId, $bookingDate);
    return $stmt->execute();
}
?>
