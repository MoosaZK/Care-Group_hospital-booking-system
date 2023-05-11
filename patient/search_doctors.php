<?php
// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());

// Fetch cities from database
$sql = "SELECT * FROM cities";
$result = mysqli_query($conn, $sql);

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Retrieve form data
    $city_id = $_POST['city_id'];
    // Fetch doctors based on city from database
    $sql = "SELECT * FROM doctors WHERE city_id = $city_id";
    $doctors_info = mysqli_query($conn, $sql);



}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View Doctors by City</title>
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
      <div class="container d-flex flex-column justify-content-center align-items-center" style="height: fit-content;">
<h1 class="m-5">View Doctors by City</h1>
    <form class="form-inline d-flex my-2" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="city_id" class=" form-label mx-3"> <h4>City:</h4> </label>
        <select name="city_id" class="form-control px-5 mx-3 " required>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['city_name']; ?></option>
          <?php } ?>
        </select>
      <button type="submit" name="submit" class="btn btn-primary  px-3 mx-3">Submit</button>
  </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) { ?>
        <h2>Doctors in <?php  $city_id = $_POST['city_id'];

            // Fetch city name from database
            $sql = "SELECT * FROM cities WHERE id = $city_id";
            $city_result = mysqli_query($conn, $sql);
            $city_row = mysqli_fetch_assoc($city_result);
            $city_name = $city_row['city_name'];
            echo $city_name;?>:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Specialization</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($doctors_info)) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['specialization']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
                </div>
</body>
</html>

<?php
// Close database connection
mysqli_close($conn);
?>
