<?php
require 'include/db.php';
require 'include/user_session.php';
require 'include/function.php';
include_once('html/user_menu.php');
include_once('html/head.php');
shipped(3);
$sql = "SELECT product.product_name, product_order.quantity, user.email FROM product JOIN product_order ON product.product_id=product_order.product_id JOIN user ON product_order.user_id=user.user_id WHERE product_order.payment_id='1' ";
$result1 = $con->query($sql);
$message .=' <table class="table table-bordered" >  
<tr>  
     <th width="5%" >Product_name</th>  
     <th width="10%">Quantity</th>  
     
</tr>  ';
            if($result1->num_rows > 0){
          while($row1 = $result1->fetch_assoc()){
     
       
        $product_name = $row['product_name'];
        $quantity = $row['quantity'];
        $email = $row['email'];
        $message .= '  
        <tr >  
             <td >'. $product_name .'</td>  
           
             <td>'. $quantity .'</td>  
             
        </tr>  
   ';  

         }
        }else{

      }
      $message .= '</table>'; 
      echo $message;
?>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page 
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 50%;
  right: 40%;
  border: 2px solid #f1f1f1;
  z-index: 9;
}
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

</style>
<div class="main">
<button class="btn btn-blue" onclick="openForm()">Open Form</button>

<div class="form-popup" id="myForm">
  <form action="/action_page.php" class="form-container">
  <h1>Address</h1>

  
    <textarea  rows="4" cols="50" class="form-control">
    </textarea>
    

    <button type="submit" class="btn btn-sm btn-green">Login</button>
    <button type="button" class="btn btn-sm btn-red" onclick="closeForm()">Close</button>
  </form>
</div>
</div>
<div class="main">
<table id="example" style="font-size: 15px;" class="table table-hover" style="width:100%">
 <thead>
     <tr>
         <th>Product id</th>
         <th>Brand</th>
         <th>Category</th>
         <th>Name</th>
         <th>Quantity</th>
         <th>Price</th>
         <th>Action</th>
    
          
     <?php
         
         $sql = "SELECT product_order.order_date, product_order.order_address, product_order.quantity, product_order.price, product_order.order_status, product_order.user_id, product.product_name FROM `product_order` JOIN product ON product_order.product_id=product.product_id WHERE product_order.user_id='$user_id' ";
         $result1 = $con->query($sql);
       if($result1->num_rows > 0){
       while($row1 = $result1->fetch_assoc()){
         $order_date = $row1['order_date'];
         $order_address= $row1['order_address'];
         $quantity = $row1['quantity'];
         $price = $row1['price'];
         $order_status = $row1['order_status'];
         $product_name = $row1['product_name'];
         $user_id = $row1['user_id'];
         

          ?>
         
     </tr>
 </thead>
 <tbody>
     <td style="text-align: center;"><?php echo $product_name; ?></td>
      <td style="text-align: center;"><?php echo $quantity; ?></td>
      <td style="text-align: center;"><?php echo $order_date; ?></td>
      <td style="text-align: center;"><?php echo $order_address; ?></td>
      <td style="text-align: center;"><?php echo $price; ?></td>
      <td style="text-align: center;"><?php echo $order_status; ?></td>
     <td style="text-align: center;">
     <button type="submit" class="btn btn-danger btn-sm delete" id="<?php echo $product_id; ?>">Delete</button><br>
     
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
<?php include_once ('html/footer_table.php');?>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>