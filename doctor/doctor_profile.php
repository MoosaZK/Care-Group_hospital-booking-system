<!DOCTYPE html>
<html>
<head>
	<title>Doctor Details</title>
<!-- Bootstrap CSS v5.2.1 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>

<nav class="navbar py-3 navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid mx-5">
          <a class="navbar-brand" href="/WE_assg2/login.html">
            Care Group 
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
			<li class="nav-item <?php echo ($activePage == 'profile') ? 'active' : ''; ?>">
        <a class="nav-link" href="/WE_assg2/doctor/doctor_profile.php">Profile</a>
      </li>
      <li class="nav-item <?php echo ($activePage == 'appointments') ? 'active' : ''; ?>">
        <a class="nav-link" href="/WE_assg2/doctor/view_appointments.php">Appointments</a>
      </li>
      <li class="nav-item <?php echo ($activePage == 'availability') ? 'active' : ''; ?>">
        <a class="nav-link" href="/WE_assg2/doctor/availability.php">Availability</a>
      </li>
            </ul>
          </div>
        </div>
      </nav>

		<?php
            // Start session
            session_start();

            // Check if doctor is logged in
            if (!isset($_SESSION['doctor_id'])) {
                // Redirect to login page
                header('Location: login.php');
                exit;
            }

            // Get doctor ID from session
            $doctor_id = $_SESSION['doctor_id'];

            // Establish database connection
            $conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());
			// Check if form is submitted
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Get form data
				$name = $_POST['name'];
				$city_id = $_POST['city_id'];
				$specialization = $_POST['specialization'];
				$username = $_POST['username'];
				$password = $_POST['password'];

				// Update doctor details in database
				$sql = "UPDATE doctors SET name='$name', specialization='$specialization', username='$username', password='$password' WHERE id='$doctor_id'";
				if (mysqli_query($conn, $sql)) {
					// Redirect to doctor profile page
					header('Location: ./availability.php');
					exit;
				} else {
					// Show error message
					echo 'Error updating record: ' . mysqli_error($conn);
				}
			}
            // Fetch doctor details from database
            $sql = "SELECT * FROM doctors WHERE id = '$doctor_id'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                // If doctor found, display details
                $row = mysqli_fetch_assoc($result);
                $name =$row['name'];
              	$city_id = $row['city_id'] ;
                $specialization = $row['specialization'];
                $username = $row['username'] ;
				$password = $row['password'];
            } else {
                // If doctor not found, show error message
                echo 'Error: Doctor not found.';
            }

            // Close database connection
            mysqli_close($conn);
        ?>
  <div class="container d-flex flex-column justify-content-center" style="height: fit-contetn; width:500px">
  <h1 class="mt-5">Account Details</h1>
		
  <!-- Doctor Profile Update Form -->
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="mt-2">
					
				<div class="form-group mb-3">
					<label for="name" class="form-label">Name</label>
					<input type="text" name="name" id="name" class="form-control" value="<?php echo $name; ?>" required>
				</div>
				<div class="form-group mb-3">
					<label for="city" class="form-label">City</label>
					<input type="text" name="city" id="city" class="form-control" value="<?php echo $city_id ?>" required>
				</div>
				<div class="form-group mb-3">
					<label for="specialization" class="form-label">Specialization</label>
					<input type="text" name="specialization" id="specialization" class="form-control" value="<?php echo $specialization; ?>" required>
				</div>
				<div class="form-group mb-3">
					<label for="username" class="form-label">Username</label>
					<input type="text" name="username" id="username" class="form-control" value="<?php echo $username; ?>" required>
				</div>
				<div class="form-group mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>"required>
				</div>
				<button type="submit" class="btn btn-primary">Update Profile</button>
			</form>



	</div>
</body>
</html>
