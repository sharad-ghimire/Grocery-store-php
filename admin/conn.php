<?php 
$username='root';
$password='';
$hostname='localhost';
$databasename='grocery';

try
{
	$conn = new pdo ("mysql:host=$hostname;dbname=$databasename",$username,$password);
}

catch(PDOException $e)
{
	echo $e->getmessage();
}

 ?>