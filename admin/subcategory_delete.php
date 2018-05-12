<?php 
include'conn.php';
$delid=$_GET['delid'];

$conn->exec("DELETE from sub_category where id='$delid'");

header("location:subcategory_view.php");

 ?>