<?php
    session_start();
    // Establish database connection
    $conn = mysqli_connect('localhost', 'root', '', 'mater') or die('Connection Failed: ' . mysqli_connect_error());

    // Fetch doctors from database
    $sql = "SELECT * FROM patients ";
    $result = mysqli_query($conn, $sql);

    // Check if delete button was clicked
    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];

        // Delete city from database
        $sql = "DELETE FROM patients WHERE id = $id";
        mysqli_query($conn, $sql);
    }
    // Check if delete button was clicked
    if (isset($_POST['update'])) {
        $id = $_POST['update'];
        $_SESSION['patient_id'] = $id;
   
        header('Location: /WE_assg2/admin/modify_patients.php');
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Patient Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #4CAF50;
            color: white;
        }
        
        .add-doctor {
            float: right;
        }
    </style>
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
        <h1>Patients Table</h1>
    </div>
    
    <table class="table table-striped mt-3">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            // If cities found, display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['address'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['password'] . '</td>';
                echo '<td class="d-flex">';
                echo '<form method="post"  action=""><button type="submit" class="btn btn-danger " name="delete" value="' . $row['id'] . '">-</button>
                 <button type="submit" class="btn btn-success " name="update" value="' . $row['id'] . '">+</button>
                 </form>';
                echo '</td>';
               
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3">No Patients found.</td></tr>';
        }
        ?>
       
    </table>
    </div>
</body>
</html>

<?php
    // Close database connection
    mysqli_close($conn);
?>
