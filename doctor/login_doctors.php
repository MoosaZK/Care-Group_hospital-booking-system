<?php
	// Start session
	session_start();

	// Establish database connection
	$conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());

	// Check for form submission
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		// Retrieve form data
		$username = $_POST['username'];
		$password = $_POST['password'];

		// Validate credentials
		$sql = "SELECT * FROM doctors WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 1) {
			// Login successful, set session variables
			$row = mysqli_fetch_assoc($result);
			$_SESSION['doctor_id'] = $row['id'];
			$_SESSION['doctor_name'] = $row['name'];

			// Redirect to doctor profile page
			header('Location: doctor_profile.php');
			exit;
		} else {
			// Login failed, show error message
			echo 'Invalid username or password';
		}
	}

	// Close database connection
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Doctor Login</title>
</head>
<body style="background-image: url(../background.png); background-size: cover;">
	<h2>Doctor Login</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>Username:</label>
		<input type="text" name="username" required><br><br>

		<label>Password:</label>
		<input type="password" name="password" required><br><br>

		<input type="submit" name="submit" value="Login">
	</form>
</body>
</html>
