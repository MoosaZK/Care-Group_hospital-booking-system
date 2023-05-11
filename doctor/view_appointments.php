<!DOCTYPE html>
<html>
<head>
    <title>View Appointments</title>
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

<div class="container my-5">
    <h1>View Appointments</h1>
    <table class="table table-striped mt-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Patient Name</th>
            <th scope="col">Appointment Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Start session
        session_start();

        // Establish database connection
        $conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());
    
        // Fetch doctor's availability from database
        $doctor_id = $_SESSION['doctor_id'];

        // Fetch appointments from database
        $sql = "SELECT id,patient_name ,appointment_date  FROM appointments WHERE doctor_id = $doctor_id ORDER BY appointment_date";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // If appointments found, display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<th scope="row">' . $row['id'] . '</th>';
                echo '<td>' . $row['patient_name'] . '</td>';
                echo '<td>' .$row['appointment_date'] . '</td>';
                echo '</tr>';
                }
            } else {
                // If no appointments found, display a message
                echo '<tr><td colspan="5">No appointments found.</td></tr>';
                }    // Close database connection
                mysqli_close($conn);
                ?>
                </tbody>
            </table>
            </div>
<!-- Bootstrap JS v5.2.1 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-2cwWtEclzKR1pApYHfyAeDkfWfIvLvPT+KsTfV7JZpW8ZNwq3eTcC+GXJlhbvuW8"
        crossorigin="anonymous"></script>
</body>
</html>            
