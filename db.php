<?php
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = "Ish@17306"; // Change this to your database password
$database = "hostel"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
