<?php
include '../ctn/Session1_koneksi.php'; // Include koneksi database
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form - Session 1</title>
    <link rel="stylesheet" href="../css/Booking.css"> <!-- Link ke CSS -->
    <script src="../js/booking2-validation.js"></script>
</head>
<body>
    <header>
    <h1>Booking Form</h1>
    </header>
    <main>
    <form method="post">
        <!-- Form fields for personal information and booking details -->
        <label for="client-name">Name:</label>
        <input type="text" name="client-name" required>

        <label for="client-email">Email:</label>
        <input type="email" name="client-email" required>

        <label for="client-address">Address:</label>
        <input type="text" name="client-address" required>

        <label for="client-region">Region:</label>
        <input type="text" name="client-region" required>

        <label for="client-city">City:</label>
        <input type="text" name="client-city" required>

        <label for="client-phone">Phone Number:</label>
                    <div class="input-group">
                    <select id="country-code" name="country-code" class="custom-select" required>
                    <option value="" disabled selected>Select your country code</option>
            <?php
            // Include the connection file
            include '../includes/koneksi.php';

            // Query to get data from country_codes table
            $sql = "SELECT id, country_name, country_code FROM country_codes";
            $result = $conn->query($sql);

            // Populate the dropdown with data from the database
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Display country name and country code
                    echo "<option value='" . $row['country_code'] . "'>" . $row['country_name'] . " (" . $row['country_code'] . ")</option>";
                }
            } else {
                echo "<option value=''>No country codes available</option>";
            }

            // Close the connection
            $conn->close();
            ?>
            </select>
                <input type="text" id="phone" name="phone" placeholder="Enter your phone number" oninput="validatePhoneNumber(this)" required>
            </div>
        </div>

        <label for="client_postal_code">Postal Code:</label>
        <input type="text" name="client_postal_code" placeholder="Enter your postal code" oninput="validatePostalCode(this)" required>

        <label for="product-name">Vehicle Type:</label>
                    <select id="product-name" name="product-name" required>
                        <option value="" disabled selected>Select your option</option>
                        <option value="CRF 150L Biru">CRF 150L Biru</option>
                        <option value="CRF 150L Hitam">CRF 150L Hitam</option>
                    </select>
                </div>

        <label for="start-time">Start Time:</label>
        <input type="datetime-local" name="start-time" required>

        <label for="end-time">End Time:</label>
        <input type="datetime-local" name="end-time" required>

        <label for="number_of_order">Number of Order:</label>
        <input type="number" name="number_of_order" required>

        <label for="special-request">Special Request:</label>
        <textarea name="special-request"></textarea>
    </main>
        <button type="submit" class="disabled enabled">Next</button>
    </form>
</body>
</html>
