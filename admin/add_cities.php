<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $conn = mysqli_connect('localhost','root','','mater') or die("Connection Failed: " .mysqli_connect_error());
       
        $city_name = $_POST['city_name'];

        $sql = "INSERT INTO `cities` (`city_name`) VALUES ('$city_name')";

        $query = mysqli_query($conn,$sql);

        if($query){
            header('Location: ./cities.php');
					exit;
        }
        else{
            echo "Error occurred";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add City</title>
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
<div class="container d-flex flex-column justify-content-center mx-5" style="height: fit-contetn;">
  <h1 class="my-3">Add New Cities</h1>

  <form method="post" action="">
		<label class="form-label">City Name:</label><br>
		<input type="text" class="form-control" name="city_name"><br>
		<input type="submit" class="btn btn-primary" name="submit" value="Add City">
	</form>
</div>
</body>
</html>
