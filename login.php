<?php

	// Start session
	session_start();
	// Establish database connection
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "mater";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	// Get form data
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];

	// Check user credentials
	if ($role == 'doctor') {
		$sql = "SELECT * FROM doctors WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 1) {
			// Login successful, redirect to doctor dashboard
            $row = mysqli_fetch_assoc($result);
			$_SESSION['doctor_id'] = $row['id'];
			$_SESSION['doctor_name'] = $row['name'];
			header('Location: doctor/doctor_profile.php');
			exit;
		} else {			echo "<script>
			alert('Invalid username or password.');
		</script>";
		}
	} elseif ($role == 'patient') {
		$sql = "SELECT * FROM patients WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 1) {
			// Login successful, redirect to patient dashboard
            $row = mysqli_fetch_assoc($result);
			$_SESSION['patient_id'] = $row['id'];
			$_SESSION['patient_id'] = $row['name'];
			header('Location: patient/search_doctors.php');
			exit;
		} else {
			echo "<script>
			alert('Invalid username or password.');
		</script>";
		}
	} elseif ($role == 'admin') {
		
		if ($username=="admin" && $password=="admin") {
			// Login successful, redirect to admin dashboard
			header('Location: admin/doctors.php');
			exit;
		} else {		
		header('Location: login.html');
			
			exit;
		}
	}

	// Close database connection
	mysqli_close($conn);
?>
