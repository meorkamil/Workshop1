<?php
require 'include/db.php';
require 'include/user_session.php';
include_once('html/user_menu.php');
include_once('html/head.php');

?>
<div class="main">
 <h1>Home<?php ?></h1>
 <hr>
</div>

<div class="main">

     <div class="boxes">
<?php
         
         $sql = "SELECT product.product_id, brand.brand_name, category.category_name, product.product_name, product.product_quantity, product.product_price, product.file_path FROM `product` INNER JOIN brand ON product.brand_id = brand.brand_id INNER JOIN category ON product.category_id=category.category_id";
         $result1 = $con->query($sql);
       if($result1->num_rows > 0){
       while($row1 = $result1->fetch_assoc()){
         $product_id = $row1['product_id'];
         $brand_name= $row1['brand_name'];
         $category_name = $row1['category_name'];
         $product_name = $row1['product_name'];
         $product_quantity = $row1['product_quantity'];
         $product_price = $row1['product_price'];
         $path = $row1['file_path'];
       
     echo '<div class="box">
     <img src="'.$path.'" alt="'.$product_name.'t" width="200" height="200">
     <h4>'.$product_name.'</h4><strong>RM '.$product_price.'</strong> <br>  
     <a href="order.php?product_id='.$product_id.'" class="btn btn-sm btn-blue"> View</a>
     </div>';
    
       }
     }
     else
       {
 

     }
     ?>
     </div>
</div>
      

<div class="main" id="show"></div>

   
</div>
</body>
</html>
<?php include_once ('html/footer_table.php');?>