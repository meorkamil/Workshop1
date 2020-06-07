<?php
require 'db.php';

 if(isset($_POST["id"]))  
 {  
      $id = $_POST['id'];
     $sql = "DELETE FROM category WHERE category.category_id='$id'";
     $con->query($sql);
	 echo 'Deleted successfully.'; 
 } 
 if(isset($_POST["brand_id"]))  
 {  
      $brand_id = $_POST['brand_id'];
     $sql = "DELETE FROM brand WHERE brand.brand_id='$brand_id'";
     $con->query($sql);
	 echo 'Deleted successfully.'; 
 } 
 if(isset($_POST["product_id"]))  
 {  
      $product_id = $_POST['product_id'];
     $sql = "DELETE FROM product WHERE product.product_id='$product_id'";
     $con->query($sql);
	 echo 'Deleted successfully.'; 
 }
 if(isset($_POST["product_order_id"]))  
 {  
     $product_order_id = $_POST['product_order_id'];
    $product_order_quantity = $_POST['product_order_quantity'];
     $update_product_id = $_POST['update_product_id'];
     $sql = "DELETE FROM product_order WHERE product_order.product_order_id='$product_order_id';";
     $sql .= "UPDATE product SET product_quantity = product_quantity + $product_order_quantity WHERE product.product_id='$update_product_id'";
    if($con->multi_query($sql) == TRUE) {
     echo 'Deleted successfully.'; 
    }else{
     echo 'Deleted error.'; 
    }
	 
 }
 ?>