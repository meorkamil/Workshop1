<?php
require 'include/db.php';
require 'include/user_session.php';
require 'include/function.php';
include_once('html/user_menu.php');
include_once('html/head.php');

if(isset($_GET['payment_id'])){

    $payment_id = $_GET['payment_id'];

    
    }

if(isset($_POST['proceed'])){


$new_book_id = $_POST['new_book_id'];
$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
 $query = "UPDATE `booking` SET `booking_status` = 'Paid', `payment` = '$file' WHERE `booking`.`book_id` = $new_book_id;";  

 if(mysqli_query($con, $query))  
 {  
      echo '<script>alert(" Payment Success ")</script>';  
 }


}
if(isset($_POST["submit"])) {

    $payment_id = $_POST['payment_id'];
    $target_dir = "upload/";
    $ext = basename($_FILES["fileToUpload"]["name"]);
    $name = md5(rand()). '' . $ext;
    $target_file =  $target_dir . $name;
    /*$target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);*/
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    

    

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
       // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo '<script>alert(" File is not an image")</script>';
        $uploadOk = 0;
    }


    if (file_exists($target_file)) {
        echo '<script>alert(" Sorry, file already exist")</script>';
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo '<script>alert("Sorry, file is to large")</script>';
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo '<script>alert(" Sorry, only JPG, JPEG, PNG and GIF are allowed")</script>' ;
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo '<script>alert(" Sorry, your file was not uploaded")</script>' ;
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $query = "UPDATE `payment` SET `payment_status` = 'Success', `file_path` = '$target_file' WHERE `payment`.`payment_id` = $payment_id;";
            $query .= "UPDATE `product_order` SET `order_status` = 'Paid' WHERE `product_order`.`payment_id` = $payment_id;";  
            
            if($con->multi_query($query)== TRUE)  
            {  
             echo '<script>alert(" Payment Success ")</script>';  
             paid($payment_id, $target_file);
             echo "<script>window.location.assign('order_status.php')</script>";
             
            }

        } else {
            echo '<script>alert(" Sorry, there was an error uploading your file ")</script>';
        }
    }
    
    
}

?><div class="main">
<h1>Payment Transaction</h1>
<hr>

<div class="boxes">
<div class="box">
<h4><strong>Item</strong></h4>
<?php
$sql = "SELECT product_order.product_id, product_order.product_order_id, product_order.order_date, product_order.order_address, product_order.quantity, product_order.price,   product_order.order_status, product_order.user_id, product.product_name, brand.brand_name FROM `product_order` JOIN product ON product_order.product_id=product.product_id JOIN brand ON product.brand_id=brand.brand_id WHERE product_order.payment_id = '$payment_id' AND product_order.user_id='$user_id' ORDER BY product_order_id DESC;";
$result1 = $con->query($sql);
if($result1->num_rows > 0){
while($row1 = $result1->fetch_assoc()){
$product_id = $row1['product_id'];
$product_order_id = $row1['product_order_id'];
$order_date = $row1['order_date'];
$order_address= $row1['order_address'];
$quantity = $row1['quantity'];
$brand_name = $row1['brand_name'];
$price = $row1['price'];
$order_status = $row1['order_status'];
$product_name = $row1['product_name'];
$user_id_order = $row1['user_id'];
 echo
 '
<h4> '.$brand_name.' '.$product_name.'                   x'.$quantity.'                        RM'.$price.'</h4>


 ';


    }
}
else{

}
$sql = "SELECT SUM(price) AS total, SUM(quantity) AS total_quantity FROM product_order WHERE product_order.payment_id = '$payment_id' AND product_order.user_id='$user_id'";
$result1 = $con->query($sql);
if($result1->num_rows > 0){
while($row1 = $result1->fetch_assoc()){
$total = $row1['total'];
$total_quantity = $row1['total_quantity'];


echo'

</div>
<div class="box">
<h4><strong>Total Price</strong></h4>
<h4><strong> RM'.$total.'</strong> </h4>
<hr>
<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="text" name="payment_id" value="'.$payment_id.'" hidden>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" class="btn btn-sm btn-green" name="submit">
</form>
</div>
</div>
';}}
else{}

?>


</body>
</html>