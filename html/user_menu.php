
<div class="sidenav">
<a href="index.php">Home</a>
  <a href="profile.php">Profile</a>
  <a href="cart.php">Cart <?php 
$user_id = $_SESSION['id'];

    $res=mysqli_query($con,"SELECT COUNT(product_order_id) AS product_order_id FROM product_order WHERE product_order.order_status='Unpaid' AND  product_order.user_id='$user_id' ");
    while($row=mysqli_fetch_array($res))
    {
      $product_id = $row['product_order_id'];
    }
   
      if($product_id == "0"){
        echo " ";
      }else{
        echo '('.$product_id.')';
      }
    
   
  ?></a>
  <a href="order_status.php">Order Status</a>
  <a href="logout.php">Logout</a>
</div>
