<?php
require 'db.php';
require 'function.php';

 if(isset($_POST["user_id"]))  
 {  
      $user_id = mysqli_real_escape_string($con, $_POST["user_id"]);  
      $user_name = mysqli_real_escape_string($con, $_POST["user_name"]);  
      $sql = "INSERT INTO user (user_id, user_name) VALUES ('".$user_id."', '".$user_name."')";  
      if(mysqli_query($con, $sql))  
      {  
           echo "Message Saved";  
      }  
 } 
 
 if(isset($_POST["category"]))  
 {   
      $category =$_POST["category"];  
      $sql = "INSERT INTO category (category_id, category_name) VALUES (NULL, '".$category."')";  
      if(mysqli_query($con, $sql))  
      {  
           echo "Category Saved";  
      }  
 } 
 if(isset($_POST["brand_name"],$_POST['category_id']))  
 {   
      //$category_id =$_POST["category_id"];  
      $brand_name =$_POST["brand_name"];  
      $category_id =$_POST["category_id"];  
      $sql = "INSERT INTO brand (brand_id, category_id, brand_name) VALUES (NULL,'$category_id',  '".$brand_name."')";  
      if(mysqli_query($con, $sql))  
      {  
           echo "Category Saved";  
      }  
 }


 if(isset($_POST["pay_later"]))  

 {    
      
     $pay_later = $_POST['pay_later'];
   
     $sql = "UPDATE `product_order` SET `order_status` = 'Pay Later' WHERE `product_order`.`product_order_id` = $pay_later;";  
      //INSERT INTO `product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_quantity`, `product_price`) VALUES (NULL, '1', '2', '1', '12', '12');
      if(mysqli_query($con, $sql))  
      {  
          received_order($pay_later);
          echo "Please Pay wthin 24 hours";  
      } 
      else{
     
          echo "error";

     }
      //,$_POST["product_brand_id"], $_POST["product_name"], $_POST["product_quantity"], $_POST["product_price"]*/
 }

 
 if(isset($_POST["address_product_order_id"]))  

 {    
      
     $address_product_order_id = $_POST['address_product_order_id'];
     $address = $_POST['address'];
   
     $sql = "UPDATE `product_order` SET `order_address` = '$address' WHERE `product_order`.`product_order_id` = $address_product_order_id;";  
      //INSERT INTO `product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_quantity`, `product_price`) VALUES (NULL, '1', '2', '1', '12', '12');
      if(mysqli_query($con, $sql))  
      {  
         
          echo "Successfully update shipping address";  
      } 
      else{
     
          echo "error";

     }
      //,$_POST["product_brand_id"], $_POST["product_name"], $_POST["product_quantity"], $_POST["product_price"]*/
 }
 ?>