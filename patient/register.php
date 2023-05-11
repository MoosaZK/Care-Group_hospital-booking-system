<?php
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
	$name = $_POST['name'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	// Insert data into database
	$sql = "INSERT INTO patients (name, address, phone, email, username, password)
	        VALUES ('$name', '$address', '$phone', '$email', '$username', '$password')";
	if (mysqli_query($conn, $sql)) {
		header('Location: http://localhost/WE_assg2/login.html');
		exit;
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	// Close database connection
	mysqli_close($conn);
?>





