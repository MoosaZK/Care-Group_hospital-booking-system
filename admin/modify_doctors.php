<?php
session_start();
    
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());

$id = $_SESSION['doctor_id'];
   
// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $city_id = $_POST['city_id'];
    $specialization = $_POST['specialization'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update data in doctors table
    $sql = "UPDATE doctors SET name='$name', city_id='$city_id', specialization='$specialization', username='$username', password='$password' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // If successful, redirect to success page
        header('Location: /WE_assg2/admin/doctors.php');
        exit;
    } else {
        // If failed, show error message
        echo 'Error: ' . mysqli_error($conn);
    }
}

// Fetch doctor details from database
    $sql = "SELECT * FROM doctors WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo 'Doctor not found.';
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modify Doctor Details</title>
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
        <a class="nav-link" href="/WE_assg2/admin/cities.php">Cities</a>
      </li>
      <li class="nav-item <?php echo ($activePage == 'appointments') ? 'active' : ''; ?>">
        <a class="nav-link" href="/WE_assg2/admin/doctors.php">Doctors</a>
      </li>
      <li class="nav-item <?php echo ($activePage == 'availability') ? 'active' : ''; ?>">
        <a class="nav-link" href="/WE_assg2/admin/patient.php">Patients</a>
      </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container d-flex flex-column justify-content-center" style="height: fit-contetn; width:500px">
  <h1 class="my-3">Modify Doctor Details</h1>

    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required><br>

        <label for="city_id" class="form-label">City:</label>
        <select name="city_id" class="form-select"required>
            <?php
            // Fetch cities from database
            $sql = "SELECT * FROM cities";
            $result = mysqli_query($conn, $sql);

            while ($city_row = mysqli_fetch_assoc($result)) {
                if ($city_row['id'] == $row['city_id']) {
                    echo '<option value="' . $city_row['id'] . '" selected>' . $city_row['city_name'] . '</option>';
                } else {
                    echo '<option value="' . $city_row['id'] . '">' . $city_row['city_name'] . '</option>';
                }
            }
            ?>
        </select><br>

        <label for="specialization" class="form-label">Specialization:</label>
        <input type="text" class="form-control" name="specialization" value="<?php echo $row['specialization']; ?>" required><br>

        <label for="username" class="form-label">Username:</label>
        <input type="text" class="form-control" name="username" value="<?php echo $row['username']; ?>" required><br>

        <label for="password" class="form-label">Password:</label>
        <input type="password" class="form-control" name="password" value="<?php echo $row['password']; ?>" required><br>

        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
    </form>
        </div>
</body>
</html>

<?php
// Close
