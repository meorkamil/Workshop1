<?php
require 'include/db.php';
require 'include/admin_session.php';
include_once('html/menu.php');
include_once('html/head.php');
?>

<div class="main">
    <div>
<button id="insert" class="btn btn-sm btn-blue">Add</button><br><br>
        <form id="submit_form">   
                <input type="text" id="category" placeholder="Category Name" class="form-control" name="category">
                <br>
                <br>
                <input type="button" name="submit" id="submit" value="submit" class="btn btn-sm btn-green"><br><br>
                <span id="error_message" class="text-danger"></span>  
                <span id="success_message" class="text-success"></span> 
        <form id="submit_form">  
</div>
<div  id="show"></div>

   
</div>
</body>
</html>
<script>
$(document).ready(function() {

      $('#show').load('include/data.php');


  $('#submit_form').hide();

  $('#insert').click(function(){
    $('#submit_form').fadeIn();
  });
  
  $('#submit').click(function(){  
     
           var category = $('#category').val();  
           if(category == '' )  
           {  
                $('#error_message').html("All Fields are required");  
           }  
           else  
           {  
                $('#error_message').html('');  
                $.ajax({  
                     url:"include/insert.php",  
                     method:"POST",  
                     data:{category:category},  
                     success:function(data){  
                          $("form").trigger("reset");  
                          $('#success_message').fadeIn().html(data);  
                          setTimeout(function(){  
                               $('#success_message').fadeOut("Slow");  
                          }, 2000);  
                          $('#show').load('include/data.php');  
                     }  
                });  
           }
          
      });

      $(document).on('click', '.delete', function(){
  var id = $(this).attr("id"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  if(confirm("Are you sure you want to remove this data?")) //Confim Box if OK then
  {
   var action = "Delete"; //Define action variable value Delete
   $.ajax({
    url:"include/delete.php",    //Request send to "action.php page"
    method:"POST",     //Using of Post method for send data
    data:{id:id}, //Data send to server from ajax method
    success:function(data)
    {
     $('#show').load('include/data.php'); // fetchUser() function has been called and it will load data under divison tag with id result
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