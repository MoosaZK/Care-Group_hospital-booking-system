<!DOCTYPE html>
<html>
<head>
	<title>Book Appointment</title>
<!-- Bootstrap CSS v5.2.1 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body style="background-image: url(../background.png); background-size: cover;">
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
              <li class="nav-item">
                <a class="nav-link " href="/WE_assg2/patient/search_doctors.php">Search Doctors</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./appointment_form.php">Book Appointment</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
	
  <div class="container d-flex flex-column justify-content-center align-items-center" style="height: 80vh;">
  	<h1 class="m-2">Book Appointment</h1> 
	<form action="book_appointment.php" method="POST">
			<label for="patient_name" class="form-label">Patient Name:</label>
			<input type="text" class="form-control" id="patient_name" name="patient_name" required><br>

			<label for="doctor_id" class="form-label">Doctor:</label>
			<select id="doctor_id" class="form-control" name="doctor_id" required>
				<option value="">Select a Doctor</option>
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

					// Retrieve list of doctors
					$sql = "SELECT * FROM doctors";
					$result = mysqli_query($conn, $sql);

					// Output options for each doctor
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
					}

					// Close database connection
					mysqli_close($conn);
				?>
			</select><br><br>

			<label for="start_date" class="form-label">Appointment Date:</label>
			<input type="date" class="form-control" id="appointment_date" name="appointment_date" required><br>

			<input type="submit" class="btn btn-primary" value="Book Appointment">
		</form>
	</div>
</body>
</html>
