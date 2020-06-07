<?php
require 'include/db.php';
require 'include/admin_session.php';
require 'include/function.php';
include_once('html/menu.php');
include_once('html/head.php');


if(isset($_GET['ship'])){


    $ship = $_GET['ship'];
   
  
  }

  if(isset($_POST['track'])){


    $payment_no = $_POST['payment_no'];
    $tracking_no = $_POST['tracking_no'];
    $sql = "UPDATE payment SET payment.tracking_id = '$tracking_no' WHERE payment.payment_id='$payment_no';";
    $sql .= "UPDATE product_order SET order_status = 'Shipped' WHERE product_order.payment_id='$payment_no'";
    if($con->multi_query($sql) === TRUE){
      shipped($payment_no);
      echo"<script>alert('Success');</script>";
      echo "<script>window.location.assign('view_order.php')</script>";
  }
  else{
    echo"<script>alert('Failed To Add');</script>";
       echo "<script>window.location.assign('shipping.php?ship='.$payment_no.'')</script>";
  }

  
  }  
?>
<div class="main">
<h1>Shipping</h1>
<hr>
<table id="example" style="font-size: 15px;" class="table table-hover" style="width:100%">
 <thead>
     <tr>
         <th> Item </th>
         <th>Quantity</th>
         <th>Price</th>
         

    
          
     <?php
       $sql = "SELECT product_order.product_id, product_order.product_order_id, product_order.order_date, product_order.order_address, product_order.quantity, product_order.price,   product_order.order_status, product_order.user_id, product.product_name, product.file_path, brand.brand_name FROM `product_order` JOIN product ON product_order.product_id=product.product_id JOIN brand ON product.brand_id=brand.brand_id WHERE product_order.payment_id='$ship' ORDER BY product_order_id DESC;";
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
       $path = $row1['file_path'];
       $user_id_order = $row1['user_id'];

          ?>
         
     </tr>
 </thead>
 <tbody>
     <td style="text-align: center;"><?php echo $product_name; ?></td>
     <td style="text-align: center;"><?php echo $quantity; ?></td>
      <td style="text-align: center;">RM <?php echo $price; ?></td>
      
     
     
       <?php
       }
     }
     else
       {
 
     ?>
     
    <?php

     }
     ?>
 </tbody>
 <tfoot>
    </table>
    <br>
 </tfoot>
 <table id="example" style="font-size: 15px;" class="table table-hover" style="width:100%">
 <thead>
     <tr>
         <th>Payment No </th>
         <th>Total</th>
         <th>Date</th>
         <th>Address</th>
         <th>status</th>

    
          
     <?php
         
         $sql = "SELECT  product_order.payment_id, SUM(price) AS total, order_date, order_status, order_address, payment.file_path FROM product_order JOIN payment ON product_order.payment_id=payment.payment_id WHERE product_order.payment_id='$ship' GROUP BY payment_id";
         $result1 = $con->query($sql);
       if($result1->num_rows > 0){
       while($row1 = $result1->fetch_assoc()){
         $payment_id = $row1['payment_id'];
         $total = $row1['total'];
         $order_date= $row1['order_date'];
         $order_status= $row1['order_status'];
         $order_address = $row1['order_address'];
         $file_path = $row1['file_path'];
         
         

          ?>
         
     </tr>
 </thead>
 <tbody>
 <form method="post">
 <input type="text" name="payment_no" value="<?php echo $payment_id;?>" hidden>
     <td style="text-align: center;"><?php echo $payment_id; ?></td>
      <td style="text-align: center;">RM <?php echo $total; ?></td>
      <td style="text-align: center;"><?php echo $order_date; ?></td>
      <td style="text-align: center;"><?php echo $order_address; ?></td>
      <td style="text-align: center;"><?php 
      if($order_status=="Paid"){
        echo '<a href="'.$file_path.'" target="blank" >Paid</a>';
      }
      else{
        echo $order_status;
      }
      ?></td>
    
    
     
       <?php
       }
     }
     else
       {
 
     ?>
     
    <?php

     }
     ?>
 </tbody>
 <tfoot>
     
 </tfoot>
</table>


<h4>Tracking Number:</h4>
<input type="text" name="tracking_no" class="form-control" required>
<button type="submit" name="track" class="btn btn-sm btn-green">Save</button>
</form>
</div>
