
<?php include'header.php';
include'conn.php';

$update=$_GET['upid'];

$data=$conn->prepare("SELECT * from category");
$data->execute();
$category=$data->fetchall(PDO::FETCH_OBJ);

$data=$conn->prepare("SELECT * from sub_category where id='$update'");
$data->execute();
$subcategory=$data->fetch(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
  $category_id=$_POST['cat_id'];
  $sub_catgory=$_POST['sub_cat'];
  $conn->exec("UPDATE sub_category set category_id='$category_id',sub_category='$sub_catgory' where id='$update'");
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
        

	<form method="post" action="#" class="col-md-6">
    <label>Product Category</label>
    <select name="cat_id" class="form-control">
      <option>Select Category</option>
      <?php foreach ($category as $row) {
        if ($row->id==$subcategory->category_id) {
          $select="selected";
        }
        else
        {
          $select="";
        }
      echo "<option value=$row->id $select>$row->category_name</option>";
    } ?>
    </select>
    <label >Add Sub-Category:- </label>
    <input type="text" name="sub_cat" value="<?=$subcategory->sub_category?>" class="form-control"><br>
    <input type="submit" name="submit" value="Update" class="btn btn-success">
  </form>


<?php include'footer.php'; ?>