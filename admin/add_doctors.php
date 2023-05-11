<?php
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());

    // Fetch cities from database
    $sql = "SELECT * FROM cities";
    $result = mysqli_query($conn, $sql);

    // Check for form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // Retrieve form data
        $name = $_POST['name'];
        $city_id = $_POST['city_id'];
        $specialization = $_POST['specialization'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Insert data into doctors table
        $sql = "INSERT INTO doctors (name, city_id, specialization, username, password) VALUES ('$name', '$city_id', '$specialization', '$username', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // If successful, redirect to success page
            header('Location: ./doctors.php');
            exit;
            
        } else {
            // If failed, show error message
            echo 'Error: ' . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Doctor Details Form</title>
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
  <h1 class="mt-5">Doctor Details Form</h1>

    
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" name="name" required><br>

        <label class="form-label" for="city_id">City:</label>
        <select name="city_id" class="form-select" required>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
            <?php } ?>
        </select><br>

        <label class="form-label" for="specialization">Specialization:</label>
        <input type="text" class="form-control" name="specialization" required><br>

        <label class="form-label" for="username">Username:</label>
        <input type="text" class="form-control" name="username" required><br>

        <label class="form-label" for="password">Password:</label>
        <input type="password" class="form-control" name="password" required><br>

        <input type="submit" class="btn btn-primary px-4 py-2" name="submit" value="Submit">
    </form>
            </div>
</body>
</html>

<?php
    // Close database connection
    mysqli_close($conn);
?>
