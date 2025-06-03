<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Hostel Management</title>
    <!-- Add this in your HTML <head> section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
     
</head>
<body style="
  background-image: url('./background.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  /* background-position: center;
  background-attachment: fixed; */"
  >

    <div class="navbar">
        <h2>Hostel Management System</h2>
    </div>
    <div class="container">
        <h1>Welcome to Our Hostel</h1>
        <p>Manage your hostel stay easily and efficiently.</p>
        <button class="btn" onclick="location.href='login.php'">Login</button>
        <button class="btn" onclick="location.href='register.php'">Sign Up</button>
        <!-- <button class="btn" onclick="location.href='laundary.php'">Sign Up</button> -->
    </div>
</body>
</html>
