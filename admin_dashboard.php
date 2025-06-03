<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
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
                <li><a href="logout.php">Logout</a></li>
            </ul>
        
    </div>
</body>
</html>
