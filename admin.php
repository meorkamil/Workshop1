<?php
require 'include/db.php';
require 'include/admin_session.php';
include_once('html/head.php');
include_once('html/menu.php');
?>
<style>
.box{
    border: 2px solid RGB(51, 51, 51);
  border-radius: 5px;
}

</style>
<div class="main">
<h1 class="text-center">Sport Equipment Sales Management System</h1>
<hr>
<div class="boxes  text-center">
        <div class="box">
        <h4 >Total Unpaid Order</h4>
        <hr>
        <?php
       
       $sql = "SELECT COUNT(product_order_id) AS total FROM product_order WHERE order_status='Unpaid' OR order_status='Pay Later'" ;
             $result = mysqli_query($con,$sql);
             $row = mysqli_fetch_array($result);
       
          echo $total_unpaid = $row['total'];
           
         
       ?> 
        </div>
        <div class="box">
        <h4 >Waiting For Shipment</h4>
        <hr>
        <?php
       
       $sql = "SELECT COUNT(product_order_id) AS total FROM product_order WHERE order_status='Unpaid' OR order_status='Pay Later'" ;
             $result = mysqli_query($con,$sql);
             $row = mysqli_fetch_array($result);
       
          echo $total_unpaid = $row['total'];
           
         
       ?> 
        </div>
       
    </div>
    <br>
    <div class="boxes  text-center">
        <div class="box">
        <h4 >Total User</h4>
        <hr>
        <?php
       $sql = "SELECT COUNT(user_id) AS total FROM user WHERE role='user'" ;
             $result = mysqli_query($con,$sql);
             $row = mysqli_fetch_array($result);
          echo $total_unpaid = $row['total'];    
       ?> 
        </div>
        <div class="box">
        <h4 >Total Category</h4>
        <hr>
        <?php
       $sql = "SELECT COUNT(category_id) AS total FROM category" ;
             $result = mysqli_query($con,$sql);
             $row = mysqli_fetch_array($result);
          echo $total_unpaid = $row['total'];    
       ?> 
        </div>
        <div class="box">
        <h4 >Total Brand</h4>
        <hr>
        <?php
       $sql = "SELECT COUNT(brand_id) AS total FROM brand" ;
             $result = mysqli_query($con,$sql);
             $row = mysqli_fetch_array($result);
          echo $total_unpaid = $row['total'];    
       ?> 
        </div>
        <div class="box">
        <h4 >Total Product</h4>
        <hr>
        <?php
       $sql = "SELECT COUNT(product_id) AS total FROM product" ;
             $result = mysqli_query($con,$sql);
             $row = mysqli_fetch_array($result);
          echo $total_unpaid = $row['total'];    
       ?>
        </div>
    </div>
</div>