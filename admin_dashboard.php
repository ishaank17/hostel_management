<?php
ob_start();
session_start();
include 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ./");
    exit();
}
$year = $_GET['year'] ?? null;
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
                <li><a href="Remedial.php">Manage Tuition</a></li>
                <li><a href="laundary.php">Manage Laundary</a></li>
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
    ?>
        <tr>
            <td><?=$row['first_name']?></td>
            <td><?=$row['last_name']?></td>
            <td><a href="delete.php?id=<?=$row['id']?>">Click Here</a></td>
        </tr>
    <?php }?>
  </tbody>
</table>
        
        
    </div>
</body>
</html>
