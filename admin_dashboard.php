<?php
ob_start();
session_start();
include 'db.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ./");
    exit();
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
                <li><a href="tuition.php">Manage Tuition</a></li>
                <li><a href="laundary.php">Manage Laundary</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        
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
    $sql="SELECT first_name,last_name,id FROM users";
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
