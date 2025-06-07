<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ./");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Add this in your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            margin-top: 50px;
        }
        .btn {
            padding: 10px;
            background: red;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 10px;
            margin: 5px;
            background: #007BFF;
            color: white;
            border-radius: 5px;
            display: inline-block;
        }
        a {
            text-decoration: none;
            color: white;
        }
    </style> -->
</head>
<body style="
  background-image: url('./background.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;">

    <div class="container">
        <h1>Welcome, <?=$_SESSION["username"]?>!</h1>
        
        
            <ul>
                <li><a href="raise_issue.php">Raise an Issue</a></li>
                <li><a href="view_issues_student.php">My Issues</a></li>
                <li><a href="Remedial.php">Remedial Management</a></li>
                <li><a href="laundary.php">Laundary</a></li>
                <li><a href="logout.php">Logout</a></li> 
            </ul>
            <ul>
                <li><a href="view_Remedial.php">My Remedial</a></li>
                <li><a href="view_laundry.php">My Laundary</a></li>
            </ul>
    
    </div>
</body>
</html>
