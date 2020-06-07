<?php
require 'include/db.php';
require 'include/user_session.php';
require 'include/function.php';
include_once('html/user_menu.php');
include_once('html/head.php');

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
}

if(isset($_POST['order_quantity'])){
    $order_quantity = $_POST['order_quantity'];
    $order_product_id = $_POST['product_id'];
    $order_product_price = $_POST['product_price'];
    
    product_order($order_quantity, $order_product_id, $user_id, $order_product_price);
    received_order();
 
}
?>
<div class="main">
 
  
  <?php
         view_product($product_id);
         
    ?>
  
   
 
 
  
</div>
</body>
</html>