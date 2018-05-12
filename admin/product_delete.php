<?php 
include'conn.php';
$delid=$_GET['delid'];

$conn->exec("DELETE from products where id='$delid'");

header("location:product_view.php");

 ?>