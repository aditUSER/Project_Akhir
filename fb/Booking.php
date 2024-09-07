<?php
include '../ctn/Session1_koneksi.php'; // Include koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap">
    <link rel="stylesheet" href="../css/Booking.css">
</head>
<body>
    <header>
        <h1>Booking Form</h1>
    </header>
    
    <main>
        <section class="client-info">
            <h2>Client Information</h2>
            <form id="booking-form">
                <div class="form-group">
                    <label for="client-name">Name:</label>
                    <input type="text" id="client-name" name="client-name" required>
                </div>
                <div class="form-group">
                <div class="form-group">
                    <label for="client-email">Email:</label> <!-- Tambahan Email -->
                    <input type="email" id="client-email" name="client-email" required>
                </div>
                    <label for="client-address">Address:</label>
                    <input type="text" id="client-address" name="client-address" required>
                </div>
                <div class="form-group">
                    <label for="client-region">Region:</label>
                    <input type="text" id="client-region" name="client-region" required>
                </div>
                <div class="form-group">
                    <label for="client-city">City:</label>
                    <input type="text" class="form-control" id="client-city" name="client-city" required>
                </div>
                <div class="form-group">
                    <label for="client-phone">Phone Number:</label>
                    <div class="input-group">
                    <select id="country-code" name="country-code" class="custom-select" required>
                    <option value="" disabled selected>Select your country code</option>
            <?php
            // Include the connection file
            include 'includes/koneksi.php';

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
                <div class="form-group">
                    <label for="client-postal-code">Postal Code:</label>
                    <input type="text" id="postal-code" name="postal-code" placeholder="Enter your postal code" oninput="validatePostalCode(this)" required>
                    <br><br>
                </div>
            </form>
        </section>
        <section class="product-session-info">
            <h2>Product and Session Information</h2>
            <form>
                <div class="form-group">
                    <label for="product-name">Vehicle Type:</label>
                    <select id="product-name" name="product-name" required>
                        <option value="" disabled selected>Select your option</option>
                        <option value="CRF 150L Biru">CRF 150L Biru</option>
                        <option value="CRF 150L Hitam">CRF 150L Hitam</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start-time">Start Time:</label>
                    <input type="date" id="start-time" name="start-time" required>
                </div>
                <div class="form-group">
                    <label for="end-time">End Time:</label>
                    <input type="date" id="end-time" name="end-time" required>
                </div>
                <div class="form-group">
                    <label for="number-of-order">Number of Order:</label>
                    <select id="number-of-order" name="number-of-order" required>
                        <option value="" disabled selected>Select your option</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="special-request">Special Request (Optional):</label>
                    <input type="text" id="special-request" name="special-request">
                </div>
            </form>
        </section>
    </main>
    
    <footer>
        <button type="button" id="next-btn" class="disabled"  disabled onclick="validateForm(); if (!document.getElementById('next-btn').disabled) { submitForm(); }">Next</button>
        <button type="button" class="btn btn-cancel">Cancel</button>
    </footer>

        <script src="../js/Index.js" defer>
    </script>
</body>
</html>
