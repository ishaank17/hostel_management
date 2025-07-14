<?php 
$id=$_GET['id'];
$sql="SELECT email from users where id=$id";
include 'db.php';
$row=$conn->query($sql)->fetch_assoc();
$email=$row['email'];
$output=shell_exec("python low_attendence.py $email");
echo "<pre>$output</pre>";
header('Location: admin_dashboard.php');