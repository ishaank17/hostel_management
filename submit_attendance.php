<?php
include 'db.php';
$date = $_POST['date'];
$status = $_POST['status'];
$id=$_POST['id'];
$sql="
    INSERT INTO attendence (student_id, date, status)
    VALUES ($id, '$date', '$status')
    ON DUPLICATE KEY UPDATE status = '$status'
";
echo $sql;
$conn->query($sql);

header("location: admin_dashboard.php");
?>
