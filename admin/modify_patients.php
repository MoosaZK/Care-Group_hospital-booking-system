<?php
session_start();
    
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());

$id = $_SESSION['patient_id'];
   
// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update data in doctors table
    $sql = "UPDATE patients SET name='$name', address='$address', phone='$phone', email='$email' , username='$username', password='$password' WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // If successful, redirect to success page
        header('Location: /WE_assg2/admin/patient.php');
        exit;
    } else {
        // If failed, show error message
        echo 'Error: ' . mysqli_error($conn);
    }
}

// Fetch doctor details from database
    $sql = "SELECT * FROM patients WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo 'Patient not found.';
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modify Patient Details</title>
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
<div class="container d-flex flex-column justify-content-center" style="height: fit-contetn;">
  <h1 class="my-3">Modify Patient Details</h1>

    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required><br>

        <label for="address" class="form-label">Address:</label>
        <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>" required><br>


        <label for="phone" class="form-label">Phone:</label>
        <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" required><br>

        <label for="email" class="form-label">Email:</label>
        <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>" required><br>

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
