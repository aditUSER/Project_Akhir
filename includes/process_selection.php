<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_vehicle_type = $_POST['vehicle_type'];

    if ($selected_vehicle_type) {
        echo "Tipe kendaraan yang dipilih: " . $selected_vehicle_type;
    } else {
        echo "Silakan pilih tipe kendaraan.";
    }
}
?>
