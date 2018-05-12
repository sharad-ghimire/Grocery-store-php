<?php include'header.php'; ?>
<?php include'conn.php';


$data=$conn->prepare("SELECT * from category inner join products on products.category_id=category.id inner join sub_category on products.subcategory_id=sub_category.id");
$data->execute();
$result=$data->fetchall(PDO::FETCH_OBJ);

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
          <div><a href="product_insert.php"><i class="fa fa-angle-double-left btn btn-primary btn-sm pull-right"> Back</i></a></div><br>
<table class="table table-bordered table-condensed">
  <tr>
    <th>ID</th>
    <th>Category Name</th>
    <th>Sub-Category Name</th>
    <th>Product Name</th>
    <th>Unit Price</th>
    <th>Unit Quantity</th>
    <th>Available Stock</th>
    <th>Delete</th>
    <th>Update</th>
  </tr>

<?php 
foreach ($result as $row) {
   echo "<tr>";
   echo "<td>$row->id</td>";
   echo "<td>$row->category_name</td>";
   echo "<td>$row->sub_category</td>";
   echo "<td>$row->product_name</td>";
   echo "<td>$row->unit_price</td>";
   echo "<td>$row->unit_quantity</td>";
   echo "<td>$row->available_stock</td>";
   echo "<td><a href='product_delete.php?delid=$row->id' class='btn btn-danger btn-sm'>Delete</a></td>";
   echo "<td><a href='product_update.php?upid=$row->id' class='btn btn-info btn-sm'>Update</a></td>";
   echo "</tr>";
 } ?>
</table>

<?php include'footer.php'; ?>