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
                <li >
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Issues
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="raise_issue.php">Raise an Issue</a>
                            <a class="dropdown-item" href="view_issues_student.php">View raised Issues</a>
                        </div>
                        </div>
                </li>
                <li >
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Remedial
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="Remedial.php">Manage Remedial</a>
                            <a class="dropdown-item" href="view_Remedial.php">View Remedials</a>
                        </div>
                        </div>
                </li>
                <li >
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Laundary
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="laundary.php">Manage Laundary</a>
                            <a class="dropdown-item" href="view_laundry.php">View My Laundary</a>
                        </div>
                        </div>
                </li>
                
                <li><a href="logout.php">Logout</a></li> 
            </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
