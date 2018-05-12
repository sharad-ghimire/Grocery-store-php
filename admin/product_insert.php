<?php include'header.php'; ?>
<?php include'conn.php';

error_reporting(0);
$data=$conn->prepare("SELECT * from category");
$data->execute();
$result=$data->fetchall(PDO::FETCH_OBJ);


if (isset($_POST['submit']))
{
  $cat_id=$_POST['cat_id'];
  $subcat_id=$_POST['subcat_id'];
  $pro_name=$_POST['pro_name'];
  $price=$_POST['price'];
  $quant=$_POST['quant'];
  $stock=$_POST['stock'];

$conn->exec("INSERT into products (category_id ,subcategory_id ,product_name ,unit_price ,unit_quantity,available_stock) values
  ('$cat_id','$subcat_id','$pro_name','$price','$quant','$stock')");


}
 ?>


      <h1>
        Add Product 
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
          <h3 class="box-title">Add Product :- </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div><a href="product_view.php"><i class="fa fa-th-list btn btn-primary btn-sm pull-right"> View</i></a></div><br>

	<form method="post" action="#" class="col-md-6" enctype="multipart/form-data">
		<label>Select Category</label>
    <select class="form-control" name="cat_id" id="cat_id">
      <option>Select Category</option>
      <?php 
      foreach ($result as $row) {
        echo "<option value=$row->id>$row->category_name</option>";
      }
       ?>
    </select>
    <label>Select Sub-Category</label>
    <select class="form-control" name="subcat_id" id="subcat_id">
    </select>
    <label>Product Name</label>
    <input type="text" name="pro_name" placeholder="Product Name" class="form-control">
    <label>Unit Price</label>
    <input type="text" name="price" placeholder="Unit Price" class="form-control">
    <label>Unit Quantity</label>
    <input type="text" name="quant" placeholder="Unit Quantity" class="form-control">
    <label>Available Stock</label>
    <input type="text" name="stock" placeholder="Available Stock" class="form-control">
    <label>Product Image</label>
    <input type="file" name="product_photo"><br>
    <input type="submit" name="submit" class="btn btn-success">
	</form>

<?php include'footer.php'; ?>

<script type="text/javascript">
  $("#cat_id").on('change',function(){
    var cat_id = $(this).val();
    $.ajax({
      url: 'subcategory_ajax.php',
      type: 'post',
      data: {'cat_id_val': cat_id},
      success: function(result)
      {
        $("#subcat_id").html(result);
      }
    })

  });

</script>