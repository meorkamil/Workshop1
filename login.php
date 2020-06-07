
 
<?php
include_once('html/head.php');
require('include/db.php');



if(isset($_POST['login'])){

  $username=$_POST['username'];
  $password=md5($_POST['password']);
  $login=$_POST['login'];

  $res = $con->query("SELECT * FROM user where user_id='$username' and password='$password'");
  $row = $res->fetch_assoc();

  $user = $row['user_id'];
  $email = $row['email'];
  $name = $row['user_name'];
  $pass = $row['password'];
  $role = $row['role'];

  if($user==$username && $pass=$password){
    session_start();
    if($role=="admin"){

      $_SESSION['mysesi']=$name;
      $_SESSION['role']=$role;
      echo"<script>alert('Just Logged In This System As ADMIN');</script>";
      echo "<script>window.location.assign('admin.php')</script>";
    } else if($role=="user"){

      $_SESSION['mysesi']=$name;
      $_SESSION['id']=$user;
      $_SESSION['role']=$role;
      echo"<script>alert('".$_SESSION['id']." You Just Logged In The System');</script>";
      echo "<script>window.location.assign('index.php')</script>";
    } else{
?>

      <script>alert("Wrong Credential");</script>

<?php
    }
  } else{
?>
      <script>alert("Enter Correct Username or Password !");</script>
<?php
  }
}
?>

    <div class="container">
   <h2 class="text-center">Sport Equipment Sales Management System</h2>
        <hr>
        <h4 class="text-center">New Product !</h4>
        <div class="boxes">
<?php
         
         $sql = "SELECT product.product_id, brand.brand_name, category.category_name, product.product_name, product.product_quantity, product.product_price, product.file_path FROM `product` INNER JOIN brand ON product.brand_id = brand.brand_id INNER JOIN category ON product.category_id=category.category_id ORDER BY product.product_id DESC LIMIT 4  ";
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
  
     </div>';
    
       }
     }

     else
       {
 

     }
  
     ?>
     </div>
     <hr>
    <div class="boxes">
      <div class="box">
      <h3 class="text-center">Login</h3>
      <form  method="post">
                <div>
                  <input type="text" class="form-control" id="username" placeholder="username" name="username">
                 </div>
                 <br>
                 <div>
                  <input type="password" class="form-control" id="password" placeholder="password" name="password">
                </div>
                <br>
                <button type="submit" name="login" class="btn btn-green ">Login</button>
                <a href="register.php" >User Registeration</a>
                </form>
      </div>
      
      
    </div>
    
  </div>

  </body>
</html> 
