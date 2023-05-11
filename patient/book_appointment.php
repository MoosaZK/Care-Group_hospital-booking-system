<?php
session_start();
// Establish database connection
$servername = "localhost";
$username = "root";
$password = ""; // replace with actual password
$dbname = "mater";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$patient_name = $_POST['patient_name'];
$doctor_id = $_POST['doctor_id'];
$appointment_date = $_POST['appointment_date'];

// Check doctor availability
$sql = "SELECT * FROM availability WHERE doctor_id = '$doctor_id' AND start_date < '$appointment_date' AND end_date > '$appointment_date' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Doctor is available, so book appointment
    $sql = "INSERT INTO appointments (patient_name, doctor_id, appointment_date) VALUES ('$patient_name', '$doctor_id', '$appointment_date')";
    if (mysqli_query($conn, $sql)) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error booking appointment: " . mysqli_error($conn);
    }
} else {
    // Doctor is not available
    echo "Doctor is not available at this time.";
}

// Close database connection
mysqli_close($conn);
?>
