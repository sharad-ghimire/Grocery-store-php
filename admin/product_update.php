<?php include'header.php'; ?>
<?php include'conn.php';

error_reporting(0);
$update=$_GET['upid'];
$data=$conn->prepare("SELECT * from category");
$data->execute();
$category=$data->fetchall(PDO::FETCH_OBJ);

$data=$conn->prepare("SELECT * from products where id='$update'");
$data->execute();
$product=$data->fetch(PDO::FETCH_OBJ);

if (isset($_POST['update'])) {
  $cat_id=$_POST['cat_id'];
  $pro_name=$_POST['pro_name'];
  $price=$_POST['price'];
  $quant=$_POST['quant'];
$conn->exec("UPDATE products set category_id='$cat_id' ,product_name='$pro_name',product_price='$price',product_quantity='$quant' where id='$update'");
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
          <div><a href="product_view.php"><i class="fa fa-plus btn btn-primary btn-sm pull-right"> View</i></a></div><br>

	<form method="post" action="#" class="col-md-6" enctype="multipart/form-data">
		<label>Select Category</label>
    <select class="form-control" name="cat_id">
      <option>Select Category</option>
      <?php 
      foreach ($category as $row) {
        if ($row->id==$product->category_id) {
          $select="selected";
        }
        else{
          $select="";
        }
        echo "<option value=$row->id $select>$row->category_name</option>";
      }
       ?>
    </select>
    <label>Product Name</label>
    <input type="text" name="pro_name" value="<?=$product->product_name?>"  class="form-control">
    <label>Product Price</label>
    <input type="text" name="price" value="<?=$product->product_price?>"  class="form-control">
    <label>Product Quantity</label>
    <input type="text" name="quant" value="<?=$product->product_quantity?>"  class="form-control">
    <label>Product Image</label>
    <input type="file" name="product_photo"><br>
    <input type="submit" name="update" value="Update" class="btn btn-success">
	</form>



<?php include'footer.php'; ?>