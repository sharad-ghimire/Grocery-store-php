<?php 
include'conn.php';
session_start();
error_reporting(0);
$p_id=$_GET['proid'];

if($p_id==""){
    $p_id=3;
}
else{
    $p_id=$_GET['proid'];
}

if(empty($_SESSION['uid'])){
    $_SESSION['uid']=rand(9999,99999);
}
else{
    $uid=$_SESSION['uid'];
}
if(!empty($_GET['action']=='removeall')){
     $conn->exec("delete from orders where u_id='$uid'");
     header("location:index.php?proid=$p_id");
}
if(!empty($_GET['product_id'])){
    $product_id=$_GET['product_id'];
    $conn->exec("insert into orders (u_id,product_id) values ('$uid','$product_id')");
    header("location:index.php?proid=$p_id");
}

if(!empty($_GET['delete'])){
    $id=$_GET['delete'];
    $conn->exec("delete from orders where id='$id'");
    header("location:index.php?proid=$p_id");
}
if(isset($_POST['sendmail'])){
    //Send Mail
    $email="patelprem1992@gmail.com";
    $sendto="patelprem1992@gmail.com";
    $name="Praveen";
    $message="hello";
              require_once('mailer/class.phpmailer.php');
              require_once('mailer/class.smtp.php');
              $mail = new PHPMailer; // call the class 
              $mail->IsSMTP();
              $mail->SMTPDebug =0;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com"; //Hostname of the mail server
    $mail->Port = 587; //Port of the SMTP like to be 25, 80, 465 or 587
    $mail->SMTPAuth = true; //Whether to use SMTP authentication
    $mail->Username = "praveen.patel.9595"; //Username for SMTP authentication any valid email created in your domain
    $mail->Password = "kzdaetzchsferfhg"; //Password for SMTP authentication
    $mail->AddReplyTo("$email", "$name"); //reply-to address
    $mail->SetFrom($email, $name); //From address of the mail
    // put your while loop here like below,
    $mail->Subject = "Contact Enquiry"; //Subject od your mail
    $mail->AddAddress($sendto, "Praveen Patel"); //To address who will receive this email
    $mail->MsgHTML($message);
    $send = $mail->Send(); //Send the mails
    if ($send) {
         header("location:index.php?msg=yes");
       
    } 
    // else {
    //     echo '<center><h3 style="color:#FF3300;">Mail error: </h3></center>' . $mail->ErrorInfo;
    // }
}
include'header.php';
error_reporting(0);

$data=$conn->prepare("SELECT * from category ");
$data->execute();
$categories=$data->fetchall(PDO::FETCH_OBJ);


$data=$conn->prepare("SELECT * from products where subcategory_id='$p_id'");
$data->execute();
$sale=$data->fetchall(PDO::FETCH_OBJ);

?>
            <!-- End header -->
            <!-- Start page content -->
            <div class="page-content">
                
                <!-- Start shop area -->
                <div class="shop-area">
                    <div class="container-fluid">
                        <?php if(!empty($_GET['msg'])){
                            echo"<center><h3 style='color:green;'>Your Order has been placed successfully!</h3></center>";
                        }?>
                        <div class="row" style="margin-top: 2%;">
                            <!-- Start shop categori area -->
                    <div class="col-sm-6">
                         <div class="row"><img src="grocery_image/grocery.jpg" width="60%" style="margin-left: 20%"><br><br>
                            <h2 class="text-center">Welcome to the Store</h2><br></div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
        <div class="categori-menu">
            <div class="sidebar-menu-title">
                <h2>Categories</h2>
            </div>
            <div class="sidebar-menu">
                <ul>
        <?php foreach ($categories as $row) { ?>
        <li><a href="#"><?= $row->category_name?></a>
            <div class="megamenudown-sub">
            <div class="mega-top">
            <div class="mega-item-menu">
            <?php 
            $data=$conn->prepare("SELECT * from sub_category where category_id='$row->id'");
            $data->execute();
            $products=$data->fetchall(PDO::FETCH_OBJ);
            foreach ($products as $key) { 
            echo "<a href='index.php?proid=$key->id'><span>$key->sub_category</span></a>";
              } ?>                                                                   
            </div>
                    
            </div>
            </div>
        </li>
        <?php } ?>
        
        </ul>
        </div>
        </div>
    </div>    
    <!-- End shop categori area -->
    <!-- Start categori content -->
    <div class="col-xs-12 col-sm-8 col-md-8">
        <div id="content-shop" class="categori-content">
            
            <!-- Start catagori short -->
            <div class="catagori-short">
               
                
            </div>
            <!-- End catagori short -->
             <div id="my-tab-content" class="tab-content">
                <!-- Start categori grid view -->
                <div id="grid" class="tab-pane active categoti-grid-view row">
                    <!-- Start featured item -->
                    
                    <?php foreach ($sale as $row) { ?>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="featured-inner">
                        
                        <div class="featured-info ">
                        <a href="#"><span class="price"> <?=$row->product_name?></span></a>
                        <span>Price:- <i class="fa fa-inr"></i> <?= $row->unit_price?></span><br>
                        <span>Quantity:- <?=$row->unit_quantity?></span><br><hr>
                        <div class="featured-button">

                            <a href="index.php?product_id=<?= $row->id;?>&proid=<?= $p_id?>"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        </div>
                       
                    </div>
                </div>
                 <?php } ?> 
                </div><br><br>
            </div>
        </div>
    </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6" style="border-left: 1px solid #ccc;    min-height: 680px;">
        <h4 class="text-center">Shopping cart</h4>
        <div class="table-responsive">
            <table class="cart-table" style="width: 100%">
                <thead>
                    <tr>
                        <th>Product name</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total=0;
                        $data=$conn->prepare("select b.id, category_id, subcategory_id, product_name, unit_price, unit_quantity, u_id, product_id, a.id as bid from orders a inner join products b on a.product_id=b.id where u_id='$uid'");
                        $data->execute();
                        $result=$data->fetchall(PDO::FETCH_OBJ);
                    
                        foreach($result as $rowz){
                    ?>
                    <tr>
                        <td>
                            <?= $rowz->product_name?>
                        </td>
                        <td>
                            <?= $rowz->unit_price?>
                        </td>
                        <td>
                            1
                        </td>
                        <td>
                             <?= $rowz->unit_price?>
                        </td>
                        <td><a href="index.php?delete=<?= $rowz->bid?>&proid=<?= $p_id?>"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    <?php 
                    $total += $rowz->unit_price;
                }?>
                    <tr>
                        <td colspan="2"></td>
                        <td >Total</td>
                        <td><b><?= $total?></b></td>
                        <td></td>
                    </tr>
                    <tr>
                                            <td colspan="5" class="actions">
                                                <div class="cartPage-btn">
                                                    <ul>
                                                        <li><a href="#" class="cbtn" onclick="buynow()">Buy Now</a></li>
                                                      
                                                        <li><a href="index.php?action=removeall&proid=<?= $p_id?>" class="cbtn">Remove All</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            </tr>
                </tbody>
            </table>
            <br>
            <hr>
            <form action="#" method="post"  id="showform" style="display: none">
                <div class="col-sm-12"><h4>General Details:</h4></div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Name</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Email</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Gender</label>
                    </div>
                    <div class="col-sm-9">
                        <label><input type="radio" name="gender"> Male</label>&nbsp;&nbsp;&nbsp;
                        <label><input type="radio" name="gender"> Female</label>
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-sm-6">
                        <label>How did you hear about us:</label>
                    </div>
                    <div class="col-sm-6">
                        <select type="text" name="hear_by" class="form-control">
                            <option>Search Engine</option>
                            <option>Facebook</option>
                            <option>Instagram</option>
                            <option>Newspaper</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                         <label>Comments</label>
                        <textarea name="comment" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-sm-12"><h4>User Account Details:</h4></div>
                 <div class="form-group">
                    <div class="col-sm-3">
                        <label>Username</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="username" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Password</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="username" class="form-control">
                    </div>
                </div>
                 <div class="form-group">
                    <div class="col-sm-4">
                        <label>Newsletter subscriptions </label>
                    </div>
                    <div class="col-sm-8">
                        <label><input type="checkbox" name="php_article" > PHP Articles</label>&nbsp;&nbsp;
                        <label><input type="checkbox" name="php_news"> PHP News</label>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" name="sendmail" class="btn btn-default">Submit</button>&nbsp;&nbsp;
                        <button type="reset" class="btn btn-default">Reset</button>&nbsp;&nbsp;
                    </div>
                </div>
            </form>


        </div>
    </div>
    </div>
</div>
</div> 
    </div>
    </div>
    </div>
    <!-- End shop area -->
    </div>
            <!-- End page content -->


<?php include'footer.php'; ?>
<script>
    function buynow(){
        $("#showform").show();
    }
</script>

