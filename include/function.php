<?php
require 'class.php';


date_default_timezone_set("Asia/Kuala_Lumpur");

function paid($payment_id, $target_file){
  Database::initialize();

 

      
     
        $res=mysqli_query(Database::$con,"SELECT payment.payment_id, SUM(product_order.price) AS price, user.email FROM payment JOIN product_order ON product_order.payment_id=payment.payment_id JOIN user ON product_order.user_id=user.user_id WHERE payment.payment_id='$payment_id'");
        while($row=mysqli_fetch_array($res))
        {
         
          $id = $row['payment_id'];
      
          $price = $row['price'];
          $email = $row['email'];
        }
      
    
    $to      = $email; // Send email to our user
    $subject = 'Received Payment Order ID = '.$id.''; // Give the email a subject 
    $message = '
 
    Thanks for buying!
    We received your payment for Order = '.$id.'.
    
    What for Shipping Process
    
 
    '; // Our message above including the link
    
    $headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
    mail($to, $subject, $message, $headers); // Send our email

}


function received_order($payment_id){
    Database::initialize();
  
   

        
       
          $res=mysqli_query(Database::$con,"SELECT payment.payment_id, SUM(product_order.price) AS price, user.email FROM payment JOIN product_order ON product_order.payment_id=payment.payment_id JOIN user ON product_order.user_id=user.user_id WHERE payment.payment_id='$payment_id'");
          while($row=mysqli_fetch_array($res))
          {
           
            $id = $row['payment_id'];
        
            $price = $row['price'];
            $email = $row['email'];
          }
        
      
      $to      = $email; // Send email to our user
      $subject = 'Order ='.$id.' Received'; // Give the email a subject 
      $message = '
   
      Thanks for buying!
      Your order received by admin.
   
      ------------------------
      Order ID = ' .$id.'
      Total Price = RM '.$price.'
      ------------------------

      Please click this link to payment:
      http://localhost/SESMS/cart.php
   
      '; // Our message above including the link
                       
      $headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
      mail($to, $subject, $message, $headers); // Send our email
  
  }


function shipped($payment_no){
    Database::initialize();
 
       
          $res=mysqli_query(Database::$con,"SELECT payment.payment_id, payment.tracking_id, product_order.order_date, user.email FROM payment JOIN product_order ON payment.payment_id=product_order.payment_id JOIN user ON product_order.user_id=user.user_id WHERE payment.payment_id='$payment_no' GROUP BY payment.payment_id ");
          while($row=mysqli_fetch_array($res))
          {
            $payment_id = $row['payment_id'];
            $tracking_id = $row['tracking_id'];
            $order_date = $row['order_date'];
            $email = $row['email'];
          }
        
      
      $to      = $email; // Send email to our user
      $subject = 'Order Id = '.$payment_id.' Shipped Out'; // Give the email a subject 
      $message = '
   
      Your order has been shipped out at '.date("Y-m-d h:i:sa").'.
   
      ------------------------
      Tracking No = ' .$tracking_id.'
      Payment No = '.$payment_id.'
      ------------------------
   
      '; // Our message above including the link
                       
      $headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
      $send = mail($to, $subject, $message, $headers); // Send our email
      if (!$send ){
        echo '<script>alert(" Error Notify User ")</script>';  
      }
      {
        echo '<script>alert("Notification Successfully Mailed ")</script>';  
      }
  
  }





function view_product($product_id) { 
  Database::initialize();
  
     $sql = "SELECT `product`.`product_name`,`product`.`product_price`,`product`.`product_quantity`,`product`.`file_path`,`brand`.`brand_name`FROM product JOIN brand ON product.brand_id=brand.brand_id WHERE product.product_id=$product_id";
      $result1 = Database::$con->query($sql);
      if($result1->num_rows > 0){
      while($row1 = $result1->fetch_assoc()){

        $product_name = $row1['product_name'];
        $product_price = $row1['product_price'];
        $product_quantity = $row1['product_quantity'];
        $brand_name = $row1['brand_name'];
        $path = $row1['file_path'];
        

      }
    }
    echo '
    <div class="boxes">
     <div class="box">
     <h1>'.$brand_name.' '.$product_name.' </h1>
     <h3> RM '.$product_price.'</h3>
     <h4>Item left '.$product_quantity.'</h4>
     <form method=POST >
     <input type="text" class="form-control" name="product_id" value="'.$product_id.'" hidden>
     <input type="text" class="form-control" name="product_price" value="'.$product_price.'" hidden>
     <input type="text" class="form-control" name="order_quantity" placeholder="Quantity">
     <button type="submit" class="btn btn-md btn-green">&#10010; Cart</button>
     </div>
     <div class="box">
     <img src="'.$path.'" alt="'.$product_name.'t" width="350" height="350">
     </div>
    </div>
   
    
    </form>
    ';
  
  
  }


  function product_order($order_quantity, $order_product_id, $user_id, $order_product_price){
    Database::initialize();
    $date_order = date("Y-m-d");
    $total_price = $order_product_price * $order_quantity;
    
    $sql = "INSERT INTO `product_order` (`product_order_id`, `product_id`, `user_id`, `quantity`, `price`, `order_date`, `order_address`, `order_status`) VALUES (NULL, '$order_product_id', '$user_id', '$order_quantity', '$total_price', '$date_order', 'No', 'Unpaid');";
    $sql .= "UPDATE product SET product_quantity = product_quantity - $order_quantity WHERE product.product_id='$order_product_id'";
    if(Database::$con->multi_query($sql) === TRUE){
  
      echo"<script>alert('Successfully Added To Cart');</script>";
      echo "<script>window.location.assign('cart.php')</script>";
  }
  else{
    echo"<script>alert('Failed To Add');</script>";
       echo "<script>window.location.assign('order.php?product_id='.$product_id.'')</script>";
  }


  }
     
  
?>