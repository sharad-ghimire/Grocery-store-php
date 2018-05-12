
<?php include'header.php';
include'conn.php';

$update=$_GET['upid'];
$data=$conn->prepare("SELECT * from category where id='$update'");
$data->execute();
$result=$data->fetch(PDO::FETCH_OBJ);

if (isset($_POST['update'])) {
	$category_name=$_POST['cat_id'];
	$conn->exec("UPDATE category set category_name='$category_name' where id='$update'");
}


 ?>



      <h1>
        Update Product Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Product Category</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        


	<form method="post" action="#">
		<label class="col-md-2">Category Name:- </label>
		<input type="text" name="cat_id" value="<?= $result->category_name?>" class="form-control"><br>
		<input type="submit" name="update" value="Update" class="btn btn-success">
	</form>


<?php include'footer.php'; ?>