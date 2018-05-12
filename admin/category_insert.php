<?php include'header.php'; ?>
<?php include'conn.php';

if (isset($_POST['submit'])) {
	$category_name=$_POST['cat_id'];
	$conn->exec("INSERT into category (category_name) values ('$category_name')");
}

 ?>
      <h1>
        Add Product Category
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
        <div class="box-body">
          <div><a href="category_view.php"><i class="fa fa-th-list btn btn-primary btn-sm pull-right"> View</i></a></div><br>

	<form method="post" action="#" class="col-md-6">
		<label >Category Name:- </label>
		<input type="text" name="cat_id" placeholder="Category Name" class="form-control"><br>
		<input type="submit" name="submit" class="btn btn-success">
	</form>
<?php include'footer.php'; ?>