<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form - Session 2</title>
    <link rel="stylesheet" href="../css/Booking.css"> <!-- Link ke CSS -->
</head>
<body>
    <header>
        <h1>Booking Form - Session 2</h1>
    </header>

    <!-- Combined Form for Upload and Emergency Contact -->
    <form id="booking2-form" action="../includes/process_booking2.php" method="post" enctype="multipart/form-data">
        <!-- Additional Information Section -->
        <section id="additional-info">
            <h2>Additional Information</h2>
            <label for="identity-card">Identity Card:</label>
            <input type="file" id="identity-card" name="identity-card" accept=".jpg,.jpeg,.png,.pdf" required>

            <label for="driver-license">Driver License:</label>
            <input type="file" id="driver-license" name="driver-license" accept=".jpg,.jpeg,.png,.pdf" required>
        </section>

        <!-- Emergency Contact Section -->
        <section id="emergency-contact">
            <h2>Emergency Contact</h2>
            <label for="emergency-contact-name">Emergency Contact Name:</label>
            <input type="text" id="emergency-contact-name" name="emergency-contact-name" required>

            <label for="emergency-contact-phone">Emergency Contact Phone:</label>
            <input type="tel" id="emergency-contact-phone" name="emergency-contact-phone" oninput="validatePhoneNumber(this)" required>

            <label for="relation">Relation:</label>
            <input type="text" id="relation" name="relation" required>
        </section>

        <!-- Button Wrapper -->
        <div class="button-wrapper">
            <button type="submit" id="submit-btn" class="btn">Submit</button>
            <button type="button" id="btn-cancel" class="btn btn-cancel">Cancel</button>
        </div>
    </form>

    <!-- Notification Section -->
    <div id="notification"></div>

    <!-- Javascript for validation and submission -->
    <script src="../js/booking2-validation.js"></script>
    <script>
        window.onload = function() {
            if (window.location.hash === "#section1" && <?php echo json_encode(isset($_SESSION['notification'])); ?>) {
                var notification = document.getElementById('notification');
                notification.textContent = 'Thank you for your registration';
                notification.style.display = 'block';
                setTimeout(function() {
                    notification.style.display = 'none';
                }, 5000); // Hide notification after 5 seconds
                <?php unset($_SESSION['notification']); ?>
            }
        }
    </script>
</body>
</html>
