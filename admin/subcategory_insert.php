<?php include'header.php'; ?>
<?php include'conn.php';

$data=$conn->prepare("SELECT * from category");
$data->execute();
$category=$data->fetchall(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
  $category_id=$_POST['cat_id'];
  $sub_category=$_POST['sub_cat'];
  $conn->exec("INSERT into sub_category (category_id,sub_category) values ('$category_id','$sub_category')");
}

 ?>
      <h1>
        Add Product Sub Category
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
          <h3 class="box-title">Product Sub-Category</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div><a href="subcategory_view.php"><i class="fa fa-th-list btn btn-primary btn-sm pull-right"> View</i></a></div><br>

	<form method="post" action="#" class="col-md-6">
    <label>Product Category</label>
    <select name="cat_id" class="form-control">
      <option>Select Category</option>
      <?php foreach ($category as $row) {
      echo "<option value=$row->id>$row->category_name</option>";
    } ?>
    </select>
    <label >Add Sub-Category:- </label>
    <input type="text" name="sub_cat" placeholder="Sub-Category Name" class="form-control">
		<input type="submit" name="submit" class="btn btn-success">
	</form>
<?php include'footer.php'; ?>