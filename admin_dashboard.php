<?php
ob_start();
session_start();
include 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ./");
    exit();
}
$year = $_GET['year'] ?? null;
$date = $_GET['date'] ?? date('Y-m-d');
$today = date('Y-m-d');

$check = mysqli_query($conn, "SELECT COUNT(*) AS count FROM attendence WHERE date = '$today'");
$data = mysqli_fetch_assoc($check);

if ($data['count'] == 0) {
    $students = mysqli_query($conn, "SELECT id FROM users");
    $inserted = 0;

    while ($row = mysqli_fetch_assoc($students)) {
        $sid = $row['id'];
        mysqli_query($conn, "
            INSERT INTO attendence (student_id, date, status)
            VALUES ($sid, '$today', 'Absent')
        ");
        $inserted++;
    }

    echo "<script>console.log('Marked all $inserted students as Absent for $today')</script>";
} else {
    echo "<script>console.log('Attendance already marked for $today')</script>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <style>
      
form {
    display: flex;
    flex-direction: row;
}
input, select, textarea {
      padding: initial;
    margin: initial;
    border: initial;
    border-radius: initial;
    font-size: initial;
}
  .year-filter-container {
    background-color: #ffffffff;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    max-width: 500px;
    margin: 2rem auto;
    font-family: 'Poppins', sans-serif;
  }

  .year-filter-container label {
    font-weight: 500;
    color: #333;
  }

  .year-filter-container input[type="number"] {
    border: 2px solid #2196f3;
    border-radius: 0.75rem;
    padding: 0.5rem 1rem;
    font-size: 1rem;
    transition: all 0.2s ease-in-out;
  }

  .year-filter-container input[type="number"]:focus {
    border-color: #2196f3;
    box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
    outline: none;
  }

  .year-filter-container .btn-primary {
    background-color: #2196f3;
    border: none;
    border-radius: 0.75rem;
    padding: 0.5rem 1.25rem;
    font-weight: 500;
  }

  .year-filter-container .btn-secondary {
    
    border-radius: 0.75rem;
    padding: 0.5rem 1.25rem;
    font-weight: 500;
  }
</style>
</head>
<body style="
  background-image: url('./background.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;">
  
    <div class="container">
        <h1>Welcome, Admin!</h1>
        
            <ul>
                <li><a href="manage_issues_admin.php">Manage Student Issues</a></li>
                <li><a href="Remedial.php">Manage Remedial</a></li>
                <li><a href="laundary.php">Manage Laundary</a></li>
                <li><a href="view_attendence.php">View Attendance</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>


        
    </div>
    <div class="year-filter-container">
      <form method="get" action="" class="row g-3 align-items-end">
        <div class="col-md-6">
          <label for="year" class="form-label">Enter Year:</label>
          <input 
            type="number" 
            class="form-control" 
            name="year" 
            id="year" 
            min="1900" 
            max="2100" 
            value="<?= htmlspecialchars($_GET['year'] ?? '') ?>" 
            placeholder="e.g. 2025"
          >
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-3">
          <a href="<?= strtok($_SERVER['REQUEST_URI'], '?') ?>" class="btn btn-secondary w-100">Clear</a>
        </div>
      </form>
    </div>

<div class="container table-responsive">
 
<table>
  <thead>
    <tr>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Deregister</th>
      <th><form action="admin_dashboard.php" method="get">
        <input onchange="this.form.submit()" type="date" name="date" id='selectedDate' value="<?=$date?>" required>
      </form></th>
    </tr>
  </thead>
  <tbody>
    <?php 
    if ($year && is_numeric($year)){
    $sql="SELECT first_name,last_name,id FROM users where year(date_of_admission)=$year";
    }
    else{
      $sql = "SELECT first_name, last_name, id FROM users";
    }


    $res=$conn->query($sql);
    while($row=$res->fetch_assoc()){
      $id=$row['id'];
    $sql1 = "SELECT status FROM attendence where student_id=$id and  date= '$date' ";
    // echo $sql1;
    $row1=$conn->query($sql1)->fetch_assoc();
    $status=$row1['status'];
    ?>
        <tr>
            <td><?=$row['first_name']?></td>
            <td><?=$row['last_name']?></td>
            <td><a href="delete.php?id=<?=$row['id']?>">Click Here</a></td>
            <td>
              <form method="POST" action="submit_attendance.php" id='myForm'>     
                <input type="hidden" name='id' value="<?=$row['id']?>">
                <input type="hidden" name='date' class="attendanceDate" value="<?=$date?>">
                <select name='status' onchange="submitWithValidation(this)">
                    <option <?= $status === 'Present' ? 'selected' : '' ?> value='Present'>Present</option>
                    <option <?= $status === 'Absent' ? 'selected' : '' ?> value='Absent'>Absent</option>
                    <option <?= $status === 'Leave' ? 'selected' : '' ?> value='Leave'>Leave</option>
                </select>
              </form>
            </td>
        </tr>
    <?php }?>
  </tbody>
</table>
        
        
    </div>

<script>

function submitWithValidation(selectElement) {
  console.log("started")
  const form = selectElement.form;
  if (form.checkValidity()) {
    console.log("submit")
    form.submit(); // only if valid
  } else {
    form.reportValidity(); // show browser error popup
  }
}
</script>
</body>

</html>
