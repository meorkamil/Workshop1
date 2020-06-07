<?php
require 'include/db.php';
require 'include/user_session.php';
require 'include/function.php';
include_once('html/user_menu.php');
include_once('html/head.php');


if(isset($_POST['address'])){

    $address = $_POST['address'];
    $sql = "UPDATE product_order SET product_order.order_address = '$address', product_order.order_status = 'Pay Later' WHERE product_order.order_status='Unpaid' AND product_order.user_id ='$user_id'";
    //$sql .= "INSERT INTO `cart` (`cart_id`, `payment`) VALUES (NULL, 'Pay Later');";

    if($con->multi_query($sql)== TRUE){
    
        
    }
    else{
      
    }
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


</style>
<div class="main">
<h1>Order Status</h1>
<hr>

<div class="boxes">
<div class="box">

<?php
echo '<table id="example" >
<thead>
    <tr>
        <th>Order ID </th>
        <th>Address </th>
        <th>Order Date</th>
        
        <th>Shipping</th>
        <th>Order Status</th>
    </tr>
</thead>
        <tbody> ';
 
$sql = "SELECT  product_order.payment_id, SUM(price) AS total, order_date, order_status, order_address, payment.tracking_id FROM product_order JOIN payment ON product_order.payment_id=payment.payment_id GROUP BY payment_id";
$result1 = $con->query($sql);
if($result1->num_rows > 0){
while($row1 = $result1->fetch_assoc()){


$id = $row1['payment_id']; 
$total= $row1['order_address'];
$order_date= $row1['order_date'];
$order_status= $row1['order_status'];
$tracking_id= $row1['tracking_id'];

echo '



<tr>

<td style="text-align: center;">'.$id.' </td>
<td style="text-align: center;">'.$total.'</td>
<td style="text-align: center;">'.$order_date.'</td>
<td style="text-align: center;" >';

if($order_status == "Pay Later"){
    echo 'Wait for payment';
}elseif($order_status == "Paid")
{
    echo 'Shipping process';
}elseif($order_status=="Shipped"){
    echo $tracking_id;
}
else{
    echo 'Still in cart';
}



echo'</td>
<td style="text-align: center;">';
if($order_status == "Pay Later"){
    echo '<a href="pay_later.php?payment_id='.$id.'">Unpaid</a>';
}elseif($order_status == "Paid")
{
    echo 'Paid';
}elseif($order_status="Shipped"){
  echo 'Shipped';
}else{
    echo '<a href="cart.php">Still in cart</a>';
}
'</td>

</tr>
';

}
}
else{

}
echo'<tfoot>
</tfoot>
</table>';
 ?>
