<?php
// Start session
session_start();

// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());


// Fetch doctor's availability from database
$doctor_id = $_SESSION['doctor_id'];
$sql = "SELECT * FROM availability WHERE doctor_id=$doctor_id";
$availability_result = mysqli_query($conn, $sql);

if (mysqli_num_rows($availability_result) == 0) {
    $start_date = date('Y-m-d'); // Set start date to today's date
    $end_date = date('Y-m-d', strtotime($start_date . '+10 days')); // Add 10 days to start date
    $sql = "INSERT INTO availability (doctor_id, start_date, end_date) VALUES ($doctor_id, '$start_date', '$end_date')";
    mysqli_query($conn, $sql);
}

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $doctor_id = $_SESSION['doctor_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    $sql = "UPDATE availability SET start_date='$start_date', end_date='$end_date' WHERE doctor_id=$doctor_id";
    mysqli_query($conn, $sql);


}

// Fetch doctors from database
$sql = "SELECT * FROM doctors";
$doctor_result = mysqli_query($conn, $sql);

// Fetch doctor's availability from database
$doctor_id = $_SESSION['doctor_id'];
$sql = "SELECT * FROM availability WHERE doctor_id=$doctor_id";
$availability_result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Set Doctor Availability</title>
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
      <div class="container d-flex flex-column  d-flex flex-column justify-content-center mt-5" style="height: fit-contetn; width:500px">
  <h1>Set Doctor Availability</h1>
    <?php while ($row = mysqli_fetch_assoc($availability_result)) { ?>

        <form method="POST" class="mt-5"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="hidden" class="form-label" name="availability_id" value="<?php echo $row['id']; ?>">
            
            <div class="form-group mb-3">
                <label class="form-label" for="start_date">Start Date:</label>
                <input type="date" class="form-control" name="start_date" value="<?php echo $row['start_date']; ?>" required><br>
            </div>
            
            <div class="form-group mb-3">
                <label class="form-label" for="end_date">End Date:</label>
                <input type="date" class="form-control" name="end_date" value="<?php echo $row['end_date']; ?>" required><br>
            </div>
            <input type="submit" class="btn btn-primary" name="update" value="Confirm">
        </form>
    <?php } ?>

    </div>
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
