<?php
require 'include/db.php';
require 'include/user_session.php';
require 'include/function.php';
include_once('html/user_menu.php');
include_once('html/head.php');

if(isset($_POST['proceed'])){


  $payment_product_order_id = $_POST['payment_product_order_id'];
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
   //$query = "UPDATE `booking` SET `booking_status` = 'Paid', `payment` = '$file' WHERE `booking`.`book_id` = $new_book_id;";  
  
  // if(mysqli_query($con, $query))  
   //{  
        echo '<script>alert(" Payment Success ")</script>';  
   //}


}
?>
<style>

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}



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
 <h1>Cart</h1>
 <span id="error_message" class="text-danger"></span>  
                <span id="success_message" class="text-success"></span>
</div>
<div class="main" id="show">
</div>
<div class="form-popup" id="myForm">
  <form class="form-container">
  <h1>Address</h1>

  
    <textarea  rows="4" cols="50" id="address" class="form-control">
    </textarea>
    

    <button type="submit" id="submit" class="btn btn-sm btn-green">Save</button>
    <button type="button" class="btn btn-sm btn-red" onclick="closeForm()">Close</button>
  </form>
</div>




<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
</body>
</html>
<script>
$(document).ready(function(){

      $('#show').load('include/cart_data.php');
      $('#submit').click(function(){  
     
     var address_product_order_id = $('#address_product_order_id').val();  
     var address = $('#address').val();  
     if(address == '' )  
     {  
          $('#error_message').html("All Fields are required");  
     }  
     else  
     {  
          $('#error_message').html('');  
          $.ajax({  
               url:"include/insert.php",  
               method:"POST",  
               data:{address_product_order_id:address_product_order_id, address:address},  
               success:function(data){  
                    $("form").trigger("reset");  
                    $('#success_message').fadeIn().html(data);  
                    setTimeout(function(){  
                         $('#success_message').fadeOut("Slow");  
                    }, 2000); 
                    $('#show').load('include/cart_data.php');  
               }  
          });  
     }
      
});

      $(document).on('click', '.delete', function(){
  var product_order_quantity = $('#product_order_quantity').val();
 var update_product_id = $('#update_product_id').val();
  var product_order_id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  if(confirm("Are you sure you want to remove this data?")) //Confim Box if OK then
  {
   var action = "Delete"; //Define action variable value Delete
   $.ajax({
    url:"include/delete.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    data:{product_order_id:product_order_id, product_order_quantity:product_order_quantity, update_product_id:update_product_id}, //Data send to server from ajax method
    success:function(data)
    { 
      
// fetchUser() function has been called and it will load data under divison tag with id result
     alert(data); 
     location.reload(true);   //It will pop up which data it was received from server side
    }
   })
  }
  else  //Confim Box if cancel then
  {
   return false; //No action will perform
  }
 });

 $(document).on('click', '.later', function(){
  var pay_later = $(this).attr("id"); 
  //This code will fetch any customer id from attribute id with help of attr() JQuery method
  if(confirm("Are you sure you want to pay this item later?")) //Confim Box if OK then
  {
   $.ajax({
    url:"include/insert.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    data:{pay_later:pay_later}, //Data send to server from ajax method
    success:function(data)
    {
      console.log(data);
     $('#show').load('include/cart_data.php'); // fetchUser() function has been called and it will load data under divison tag with id result
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