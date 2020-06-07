<?php
 require 'db.php';
 include_once ('../html/head.php');
?>
 <table id="example" class="table table-hover" style="width:100%">
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
         

          ?>
         
     </tr>
 </thead>
 <tbody>
     <td style="text-align: center;"><?php echo $product_id; ?></td>
      <td style="text-align: center;"><?php echo $brand_name; ?></td>
      <td style="text-align: center;"><?php echo $category_name; ?></td>
      <td style="text-align: center;"><a href="<?php echo $path;?>" target="_blank"><?php echo $product_name; ?></a></td>
      <td style="text-align: center;"><?php echo $product_quantity; ?></td>
      <td style="text-align: center;">RM <?php echo $product_price; ?></td>
     <td style="text-align: center;">
     <button type="submit" class="btn btn-red btn-sm delete" id="<?php echo $product_id; ?>">&#9747;</button><br>
     
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
<?php include_once ('../html/footer_table.php');?>
