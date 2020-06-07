<?php
require 'db.php';
require 'function.php';
include_once ('../html/head.php');


?>

<table id="example" style="font-size: 15px;" class="table table-hover" style="width:100%">
 <thead>
     <tr>
         <th>Order Id </th>
         <th>Quantity</th>
         <th>Date</th>
         <th>Address</th>
         <th>status</th>
         <th>Action</th>
    
          
     <?php
         
         $sql = "SELECT  product_order.payment_id, SUM(price) AS total, order_date, order_status, order_address, payment.file_path FROM product_order JOIN payment ON product_order.payment_id=payment.payment_id GROUP BY payment_id";
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
    
     <td style="text-align: center;">
     <?php 
      if($order_status=="Paid"){
        echo '  <a  class="btn btn-danger btn-xs ship"  OnClick="return confirm("Are you confirm?");" href="shipping.php?ship='.$payment_id.'" >&#9992;</a>';
      }
      elseif($order_status=="Shipped"){
        
      }
      else{
        echo '  <a  class="btn btn-red btn-xs ship"  OnClick="return confirm("Are you confirm?");" href="shipping.php?ship='.$payment_id.'" >&#9747;</a>';
      }
      ?>
   <br>
     
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
