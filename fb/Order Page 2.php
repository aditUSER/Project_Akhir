<?php
session_start();
include 'includes/koneksi.php'; 

// Periksa apakah data sesi tersedia; jika tidak, arahkan kembali ke Booking.php
if (!isset($_SESSION['client_name'])) {
    header("Location: Booking.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari sesi
    $client_name = $_SESSION['client_name'];
    $client_address = $_SESSION['client_address'];
    $client_email = $_SESSION['client_email']; 
    $client_region = $_SESSION['client_region'];
    $client_city = $_SESSION['client_city'];
    $client_phone = $_SESSION['client_phone'];
    $client_postal_code = $_SESSION['client_postal_code'];
    $product_name = $_SESSION['product_name']; 
    $start_time = $_SESSION['start_time'];
    $end_time = $_SESSION['end_time'];
    $number_of_order = $_SESSION['number_of_order'];
    $special_request = $_SESSION['special_request']; 

    // Ambil data dari formulir Order Page 2.php
    $vehicle_name = $_POST['vehicle-name'];
    $plate_vehicle = $_POST['plate-vehicle'];
    $vehicle_type = $_POST['vehicle_type'];
    $emergency_contact_name = $_POST['emergency-contact-name'];
    $emergency_contact_phone = $_POST['emergency-contact-phone'];
    $relation = $_POST['relation'];

    // Validasi dan proses unggah file (identity_card dan driver_license)
    if ($_FILES['identity_card']['error'] == 0 && $_FILES['driver_license']['error'] == 0) {
        $identity_card = $_FILES['identity_card']['name'];
        $driver_license = $_FILES['driver_license']['name'];

        // Tentukan lokasi direktori untuk upload file
        $target_dir = "../uploads/"; 
        $identity_card_path = $target_dir . basename($identity_card);
        $driver_license_path = $target_dir . basename($driver_license);

        // Pindahkan file ke direktori tujuan
        if (move_uploaded_file($_FILES["identity_card"]["tmp_name"], $identity_card_path) && 
            move_uploaded_file($_FILES["driver_license"]["tmp_name"], $driver_license_path)) {

            // Sanitasi semua input pengguna
            $client_name = mysqli_real_escape_string($conn, $client_name);
            // ... sanitasi semua variabel lainnya ...

            // Gabungkan data dan masukkan ke dalam database
            $sql = "INSERT INTO bookings (client_name, client_address, client_email, client_region, client client_city, client_phone, client_postal_code, product_name, start_time, end_time, number_of_order, special_request, vehicle_name, plate_vehicle, vehicle_type, emergency_contact_name, emergency_contact_phone, relation, identity_card, driver_license) 
                    VALUES ('$client_name', '$client_address', '$client_email', '$client_region', '$client_city', '$client_phone', '$client_postal_code', '$product_name', '$start_time', '$end_time', '$number_of_order', '$special_request', '$vehicle_name', '$plate_vehicle', '$vehicle_type', '$emergency_contact_name', '$emergency_contact_phone', '$relation', '$identity_card', '$driver_license')"; 


            if ($conn->query($sql) === TRUE) {
            echo "Data berhasil disimpan.";
            // Opsional, arahkan ke halaman sukses
            // header("Location: success.php");
            // exit();
                } else
            {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        } else 
    {
            echo "Gagal mengunggah file.";
        }
        } else 
    {
        echo "Error dalam pengunggahan file.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page 2</title>
    <link rel="stylesheet" href="css/Booking.css">
    <link rel="stylesheet" href="css/button-styles.css"> <!-- Link ke CSS khusus untuk button -->
    <script src="js/Index.js" defer>
    </script>
</head>
<body>
    <div class="container">
        <!-- Personal Vehicle Section -->
        <section id="personal-vehicle">
            <h2>Personal Vehicle*</h2>
            <div class="bubble" id="vehicle-bubble">
                <p>Your vehicle is for guarantee during rent period.</p>
            </div>
            <form action="includes/process_selection.php" method="post">
                <label for="vehicle-name">Name of Vehicle:</label>
                <input type="text" id="vehicle-name" name="vehicle-name" required>

                <label for="plate-vehicle">Plate Vehicle:</label>
                <input type="text" id="plate-vehicle" name="plate-vehicle" required>
                
                <!-- Dropdown for Type Vehicle -->
                <label for="vehicle-type">Type Vehicle:</label>
                <select id="vehicle-type" name="vehicle_type" required>
                    <option value="" disabled selected>Select Vehicle Type</option>
                    <?php
                    // Include the connection file
                    include 'includes/koneksi.php';

                    // Query to get data from motor_brands table
                    $sql = "SELECT id, brand_name FROM motor_brands";
                    $result = $conn->query($sql);

                    // Populate the dropdown with data from the database
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['brand_name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No vehicle types available</option>";
                    }

                    // Close the connection
                    $conn->close();
                    ?>
                </select>
            </form>
        </section>

        <!-- Additional Information Section -->
        <section id="additional-info">
            <h2>Additional Information</h2>
            <form action="includes/process_upload.php" method="post" enctype="multipart/form-data">
                <label for="identity-card">Identity Card:</label>
                <input type="file" id="identity-card" name="identity-card" accept=".jpg,.jpeg,.png,.pdf" required>

                <label for="driver-license">Driver License:</label>
                <input type="file" id="driver-license" name="driver-license" accept=".jpg,.jpeg,.png,.pdf" required>
            </form>
        </section>

        <!-- Emergency Contact Section -->
        <section id="emergency-contact">
            <h2>Emergency Contact</h2>
            <form method="post" novalidate>
            <label for="emergency-contact-name">Emergency Contact Name:</label>
            <input type="text" id="emergency-contact-name" name="emergency-contact-name" required>

            <label for="emergency-contact-phone">Emergency Contact Phone:</label>
            <input type="tel" id="emergency-contact-phone" name="emergency-contact-phone" required>

            <label for="relation">Relation:</label>
            <input type="text" id="relation" name="relation" required>
            </form>
        </section>

        <!-- Button Wrapper -->
        <div class="button-wrapper">
            <button type="button" id="submit-btn" class="btn">Submit</button>
            <button type="button" id="btn-cancel" class="btn btn-cancel">Cancel</button>
        </div>
    </div>
</body>
</html>
