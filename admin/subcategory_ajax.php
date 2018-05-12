<?php 
include'conn.php';

$value=$_POST['cat_id_val'];
$data=$conn->prepare("SELECT * from sub_category where category_id='$value'");
$data->execute();
$result=$data->fetchall(PDO::FETCH_OBJ);

foreach ($result as $key) {
	echo "<option value=$key->id>$key->sub_category</option>";
}

 ?>
