<?php include'header.php'; ?>
<?php include'conn.php'; 
$data=$conn->prepare("SELECT * from category inner join sub_category on sub_category.category_id=category.id  ");
$data->execute();
$sub_category=$data->fetchall(PDO::FETCH_OBJ);

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

        	<div><a href="subcategory_insert.php"><i class="fa fa-angle-double-left btn btn-info btn-sm pull-right"> Back</i></a></div>

        	<div class="col-md-6">
        	<table class="table table-bordered table-hover">
        	<tr>
        	<th>ID</th>
        	<th>Category Name</th>
        	<th>Sub Sategory Name</th>
          <th>Remove</th>
        	<th>Update</th>
        	</tr>
        	<?php 
        	foreach ($sub_category as $key) {
        	 	echo "<tr>";
        	 	echo "<td>$key->id</td>";
            echo "<td>$key->category_name</td>";
        	 	echo "<td>$key->sub_category</td>";
            echo "<td><a href='subcategory_delete.php?delid=$key->id' class='btn btn-danger btn-sm'>Delete</a></td>";
            echo "<td><a href='subcategory_update.php?upid=$key->id' class='btn btn-info btn-sm'>Update</a></td>";
        	 	echo "</tr>";
        	 } ?>
        	</table>
        	</div>
  <?php include'footer.php'; ?>