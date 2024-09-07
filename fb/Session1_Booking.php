<?php
include '../ctn/Session1_koneksi.php'; // Include koneksi database
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap">
    <link rel="stylesheet" href="../css/Booking.css"> <!-- Link ke CSS -->
</head>
<body>
    <header>
        <h1>Booking Form</h1>
    </header>
    <main>
        <form id="booking-form" method="post">
            <section class="client-info">
                <h2>Client Information</h2>
                <div class="form-group">
                    <label for="client-name">Name:</label>
                    <input type="text" id="client-name" name="client-name" required>
                </div>
                <div class="form-group">
                <div class="form-group">
                    <label for="client-email">Email:</label>
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
                    <input type="text" id="client-city" name="client-city" required>
                </div>
                <div class="form-group">
                    <label for="client-phone">Phone Number:</label>
                    <div class="input-group">
                        <select id="country-code" name="country-code" class="custom-select" required>
                            <option value="" disabled selected>Select your country code</option>
                        <?php
                            // Query to get data from country_codes table
                            $sql = "SELECT id, country_name, country_code FROM country_codes";
                            $result = $conn->query($sql);

                            // Populate the dropdown with data from the database
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
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
                            <input type="text" id="client-postal-code" name="client-postal-code" oninput="validatePostalCode(this)" required>
                    </div>
                </section>

            <section class="product-session-info">
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
                    <input type="datetime-local" id="start-time" name="start-time" required>
                </div>
                <div class="form-group">
                    <label for="end-time">End Time:</label>
                    <input type="datetime-local" id="end-time" name="end-time" required>
                </div>
                <div class="form-group">
                    <label for="number-of-order">Number of Order:</label>
                    <input type="number" id="number-of-order" name="number-of-order" required>
                </div>
                <div class="form-group">
                    <label for="special-request">Special Request:</label>
                    <textarea id="special-request" name="special-request"></textarea>
                </div>
            </section>

            <footer>
                <button type="submit">Next</button>
            </footer>
                <script src="../js/booking2-validation.js" defer>
            </script>
        </form>
    </main>
</body>
</html>
