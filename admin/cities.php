<?php
    // Start session
    session_start();

// Establish database connection
$conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());

// Check if delete button was clicked
if (isset($_POST['delete'])) {
    $id = $_POST['delete'];

    // Delete city from database
    $sql = "DELETE FROM cities WHERE id = $id";
    mysqli_query($conn, $sql);
}

// Fetch cities from database
$sql = "SELECT * FROM cities";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Cities</title>
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

<div class="container my-5">
    <div class="d-flex justify-content-between mb-3">
        <h1>Cities</h1>
        <button class="btn btn-primary" onclick="location.href='add_cities.php'">Add City</button>
    </div>
    <table class="table table-striped mt-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">City Name</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            // If cities found, display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<th scope="row">' . $row['id'] . '</th>';
                echo '<td>' . $row['city_name'] . '</td>';
                echo '<td class="d-flex">';
                echo '<form method="post"  action=""><button type="submit" class="btn btn-danger " name="delete" value="' . $row['id'] . '">-</button></form>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3">No cities found.</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
