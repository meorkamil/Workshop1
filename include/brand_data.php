<?php
 require 'db.php';
 include_once ('../html/head.php');
?>
 <table id="example" class="table table-hover" style="width:100%">
 <thead>
     <tr>
         <th>Brand id</th>
         <th>Name</th>
         <th>Action</th>
    
          
     <?php
         
         $sql = "SELECT `brand_id`,`brand_name`FROM brand ";
         $result1 = $con->query($sql);
       if($result1->num_rows > 0){
       while($row1 = $result1->fetch_assoc()){

         $brand_id= $row1['brand_id'];
         $brand_name = $row1['brand_name'];
         

          ?>
         
     </tr>
 </thead>
 <tbody>
     <td style="text-align: center;"><?php echo $brand_id; ?></td>
      <td style="text-align: center;"><?php echo $brand_name; ?></td>
     <td style="text-align: center;">
     <button type="submit" class="btn btn-red btn-sm delete" id="<?php echo $brand_id; ?>">&#9747;</button><br>
     
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
