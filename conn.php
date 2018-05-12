<?php 
$username='potiro';
$password='pcXZb(kL';
$hostname='rerun.it.uts.edu.au';
$databasename='poti';

try
{
	$conn = new pdo ("mysql:host=$hostname;dbname=$databasename",$username,$password);
}

catch(PDOException $e)
{
	echo $e->getmessage();
}

 ?>