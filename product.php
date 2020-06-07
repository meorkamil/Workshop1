<?php
require 'include/db.php';
require 'include/admin_session.php';
include_once('html/menu.php');
include_once('html/head.php');

if(isset($_POST["submit"]))  
{    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity']; 
     $product_brand_id =$_POST["brand_id"];  
     $product_category_id =$_POST["category_id"];  
     $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }


    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $sql = "INSERT INTO product (product_id, category_id, brand_id, product_name, product_quantity, product_price, file_path) VALUES (NULL,'.$product_category_id.',  '".$product_brand_id."',  '".$product_name."',  '".$product_quantity."',  '".$product_price."',  '".$target_file."')";  
          //INSERT INTO `product` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_quantity`, `product_price`) VALUES (NULL, '1', '2', '1', '12', '12');
          if(mysqli_query($con, $sql))  
          {  
               echo "Product Saved";  
          }  

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
     
     //,$_POST["product_brand_id"], $_POST["product_name"], $_POST["product_quantity"], $_POST["product_price"]
}
?>


<div class="main">
<button id="insert" class="btn btn-sm btn-blue">Insert</button><br><br>
<form method="post" id="submit_form" enctype="multipart/form-data">   
                  
<select  class="form-control" id="product_category_id" name="category_id">
             <option >- Select Category -</option>
           <?php $res=mysqli_query($con,"SELECT  `category_id` ,`category_name` FROM `category`");
				while($row=mysqli_fetch_array($res))
				{
					?>
				<option  value="<?php echo $row['category_id']?>" ><?php echo $row["category_name"];?></option>
				<?php
				}
           ?>

            </select><br><br>
              
            <select  class="form-control" id="product_brand_id" name="brand_id">
             <option >- Select Brand -</option>
           <?php $res=mysqli_query($con,"SELECT  `brand_id` ,`brand_name` FROM `brand`");
				while($row=mysqli_fetch_array($res))
				{
					?>
				<option  value="<?php echo $row['brand_id']?>" ><?php echo $row["brand_name"];?></option>
				<?php
				}
           ?>

            </select><br>
            <br>
            <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="text" id="product_name" class="form-control" name="product_name" placeholder="Product Name">
                <br>
                <br>
                <input type="text" id="product_quantity" class="form-control" name="product_quantity" placeholder="Product Quantity">
                <br>
                <br>
                <input type="text" id="product_price" class="form-control" name="product_price" placeholder="Product Price">
                <br>
                <br>
                <input type="submit" value="Upload Image" name="submit">
                <span id="error_message" class="text-danger"></span>  
                <span id="success_message" class="text-success"></span> 
                </form id="submit_form">  
</div>
<div class="main" id="show"></div>
</body>
</html>
<script>
$(document).ready(function() {
     $('#show').load('include/product_data.php');

  $('#submit_form').hide();

  $('#insert').click(function(){
    $('#submit_form').fadeIn();
  });
  
  $('#xx').click(function(){  
          var product_brand_id= $('#product_brand_id').val();  
           var product_category_id = $('#product_category_id').val(); 
           var product_name = $('#product_name').val();
           var product_quantity = $('#product_quantity').val();
           var product_price = $('#product_price').val();
           var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  

           if(product_name == ' ')  
           {  
                $('#error_message').html("All Fields are required");  
           }
           else  
           {  
                $('#error_message').html('');  
                $.ajax({  
                     url:"include/insert.php",  
                     method:"POST",  
                     data:{product_category_id:product_category_id, product_brand_id:product_brand_id, product_name:product_name,  product_quantity:product_quantity, product_price:product_price},  
                     success:function(data){  
                          $("form").trigger("reset");  
                          $('#success_message').fadeIn().html(data);  
                          setTimeout(function(){  
                               $('#success_message').fadeOut("Slow");  
                          }, 2000);
                          $('#show').load('include/product_data.php');   
                     }  
                });  
           }  
          
      });  
      $(document).on('click', '.delete', function(){
  var product_id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  if(confirm("Are you sure you want to remove this data?")) //Confim Box if OK then
  {
   var action = "Delete"; //Define action variable value Delete
   $.ajax({
    url:"include/delete.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    data:{product_id:product_id}, //Data send to server from ajax method
    success:function(data)
    {
     $('#show').load('include/product_data.php'); // fetchUser() function has been called and it will load data under divison tag with id result
     alert(data);    //It will pop up which data it was received from server side
    }
   })
  }
  else  //Confim Box if cancel then
  {
   return false; //No action will perform
  }
 });  

});
</script>