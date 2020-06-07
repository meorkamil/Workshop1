<?php
require 'include/db.php';
require 'include/user_session.php';
require 'include/function.php';
include_once('html/user_menu.php');
include_once('html/head.php');


if(isset($_POST['address'])){
    
      
  $res=mysqli_query($con,"SELECT MAX(payment_id) AS id FROM payment");
  while($row=mysqli_fetch_array($res))
  {
      $id=$row['id'];
  }

  $payment_id = $id + 1;
    $address = $_POST['address'];
    $price = $_POST['price'];
    $sql = "UPDATE product_order SET product_order.order_address = '$address', product_order.payment_id= '$payment_id', product_order.order_status= 'Pay Later' WHERE product_order.order_status='Unpaid' AND product_order.user_id ='$user_id';";
    $sql .="INSERT INTO `payment` (`payment_id`, `payment_status`) VALUES ('$payment_id', 'Pay Later');";

    if($con->multi_query($sql)== TRUE){
    received_order($payment_id);
        echo"<script>alert('Proceed to payment');</script>";
      echo "<script>window.location.assign('order_status.php')</script>";
    }
    else{
      
    }
}





?>
<div class="main">
<h1>Shipping Address / Payment</h1>
<hr>

<div class="boxes">
<div class="box">
<h4><strong>Item</strong></h4>
<?php
$sql = "SELECT product_order.product_id, product_order.product_order_id, product_order.order_date, product_order.order_address, product_order.quantity, product_order.price,   product_order.order_status, product_order.user_id, product.product_name, brand.brand_name FROM `product_order` JOIN product ON product_order.product_id=product.product_id JOIN brand ON product.brand_id=brand.brand_id WHERE product_order.order_status = 'Unpaid' AND product_order.user_id='$user_id' ORDER BY product_order_id DESC;";
$result1 = $con->query($sql);
if($result1->num_rows > 0){
while($row1 = $result1->fetch_assoc()){
$product_id = $row1['product_id'];
$product_order_id = $row1['product_order_id'];
$order_date = $row1['order_date'];
$order_address= $row1['order_address'];
$quantity = $row1['quantity'];
$brand_name = $row1['brand_name'];
$price = $row1['price'];
$order_status = $row1['order_status'];
$product_name = $row1['product_name'];
$user_id_order = $row1['user_id'];
 echo
 '
<h4> '.$brand_name.' '.$product_name.'                   x'.$quantity.'                        RM'.$price.'</h4>


 ';


    }
}
else{

}
$sql = "SELECT SUM(price) AS total, SUM(quantity) AS total_quantity FROM product_order WHERE product_order.order_status = 'Unpaid' AND product_order.user_id='$user_id'";
$result1 = $con->query($sql);
if($result1->num_rows > 0){
while($row1 = $result1->fetch_assoc()){
$total = $row1['total'];
$total_quantity = $row1['total_quantity'];


echo'

</div>
<div class="box">
<h4><strong>Total Price</strong></h4>
<h4><strong> RM'.$total.'</strong> </h4>

</div>
</div>
';}}
else{}

?>
<hr><form method="post">
    <div class="boxes">
     <div class="box">
   
     <h3>Address</h3>
     <input type="text" name="price" value="<?php echo $total;?>" hidden>
     <textarea class="form-control" name="address" rows="5" cols="50"></textarea>
     </div>
     <div class="box">
     <h3>Payment</h3>
     <button type="submit" class="btn btn-sm btn-blue">Pay later</button><br>
     </form>
        <a class="btn btn-sm btn-yellow" >Pay Now</a>
        
     </div>
    </div>
</div>

</body>
</html>