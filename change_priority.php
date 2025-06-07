<?php 
include "db.php";
$id=$_GET["id"];
$p=$_GET["p"];
if($p==="urgent")$p="normal";
else $p="urgent";

$sql="UPDATE issues SET priority='$p' WHERE issue_id=$id";
echo $sql;
if ($conn->query($sql))
header("Location: ./manage_issues_admin.php");
?>