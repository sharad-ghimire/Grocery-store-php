<?php 
include'conn.php';
$delid=$_GET['delid'];

$conn->exec("DELETE from category where id='$delid'");

header("location:category_view.php");

 ?>