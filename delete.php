<?php
session_start();
include 'db.php';
$id=$_GET["id"];
$sql="DELETE FROM users WHERE id=$id";
$res=$conn->query($sql);
header("Location: ./admin_dashboard.php")


?>