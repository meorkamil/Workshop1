<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registeration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
  </head>
  <?php
require 'include/db.php';
if(isset($_POST['register'])){

    $user_id = mysqli_real_escape_string($con,$_POST['user_id']);
    $user_name =  mysqli_real_escape_string($con,$_POST['user_name']);
    $email =  mysqli_real_escape_string($con,$_POST['email']);
    $password_1 =  mysqli_real_escape_string($con,$_POST['password_1']);
    $password_2 = mysqli_real_escape_string($con,$_POST['password_2']);

    if($password_1==$password_2 && $user_id != ""){

        $password_md5 = md5($password_1);
        $sql = "INSERT INTO user (user_id, email, password, user_name,  role) VALUE ('$user_id','$email','$password_md5', '$user_name', 'user');";

        if($con->multi_query($sql) == TRUE){
            echo"<script>alert('User ".$user_name." Your Are Successfully Registered In This System');</script>";
            echo "<script>window.location.assign('login.php')</script>";

         }
         else{
            $exist= '<h5 class="text-red"><strong>'.$user_id.'</strong> Already Exist !</h5>';
         }
         
    

    }else{
        $error= '<h5 class="text-red">Password Did Not Match</h5><h5 class="text-red">All Field Are Required</h5>';
    }

}
?>
  <body>

<div class="container">
    <h1 class="text-center">User Registeration</h1>
    <br>
    <?php
    if(isset($error)) { echo $error; }
    if(isset($success)) { echo $success; }
    if(isset($exist)) { echo $exist; }
    ?>
    <div class="row">
        <form method="POST">
            <div class="col-sm-offset-3">
           
                <div>            
                    <input type="text"  class="form-control" name="user_id" id="user_id" placeholder="Username" maxlength="13">
                </div>
                <br>
                <div>            
                    <input type="text" name="user_name" class="form-control" id="user_name" placeholder="Name" maxlength="21">
                </div>
                <br>
                <div>
                    <input type="email" name="email" class="form-control" id="password_2" placeholder="Email">
                </div>
                <br>
                <div>               
                   <input type="password" name="password_1" class="form-control" id="password_1" placeholder="Enter Password">
                </div>
                <br>
                <div>
                    <input type="password" name="password_2" class="form-control" id="password_2" placeholder="Confirm Password">
                </div>
                <br>
                <button type="submit" name="register" class="button button4">Register</button>
                <a href="login.php" class="text-red">Cancel</a>
            </div>
        </form>
       
    </div>
</div>


  </body>
</html> 
