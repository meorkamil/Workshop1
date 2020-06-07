<?php
 require 'db.php';
 include_once ('../html/head.php');
?>
 <table id="example" class="table table-hover" style="width:100%">
 <thead>
     <tr>
       
         <th>Name</th>
         <th>Action</th>
    
          
     <?php
         
         $sql = "SELECT `category_id`,`category_name`FROM category  ORDER BY category_id DESC";
         $result1 = $con->query($sql);
       if($result1->num_rows > 0){
       while($row1 = $result1->fetch_assoc()){

         $category_id= $row1['category_id'];
         $category_name = $row1['category_name'];
         

          ?>
         
     </tr>
 </thead>
 <tbody>
    
      <td style="text-align: center;"><?php echo $category_name; ?></td>
     <td style="text-align: center;">
     <button type="submit" class="btn btn-red btn-xs delete" id="<?php echo $category_id; ?>">&#9747;</button><br>
     
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
