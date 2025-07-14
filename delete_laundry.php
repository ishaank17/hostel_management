<?php
$id=$_GET['id'];
$sql="DELETE  from laundry where id=$id";
include 'db.php';
$row=$conn->query($sql);
$email=$row['email'];

header('Location: laundary.php');
?>