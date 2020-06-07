<?php
require 'db.php';
require 'user_session.php';

echo '<table id="example" style="font-size: 15px;" class="table table-hover" style="width:100%">
<thead>
    <tr>
      
        <th>Product </th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Action</th>
        </thead>
        <tbody> 
        </tr>
      </thead>
      <tbody>';
 
$sql = "SELECT product_order.product_id, product_order.product_order_id, product_order.order_date, product_order.order_address, product_order.quantity, product_order.price,   product_order.order_status, product_order.user_id, product.product_name, product.file_path, brand.brand_name FROM `product_order` JOIN product ON product_order.product_id=product.product_id JOIN brand ON product.brand_id=brand.brand_id WHERE product_order.order_status = 'Unpaid' AND product_order.user_id='$user_id' ORDER BY product_order_id DESC;";
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
$path = $row1['file_path'];
$user_id_order = $row1['user_id'];



echo '



<tr>

<td style="text-align: center;"><img src="'.$path.'" alt="'.$product_name.'t" width="20" height="20"> '.$brand_name.' '.$product_name.'</td>
<td style="text-align: center;">'.$quantity.'</td>
<td style="text-align: center;">RM '.$price.'</td>
<td style="text-align: center;"> 
<input type="text" id="product_order_quantity" name="product_order_quantity" value="'.$quantity.'" hidden>
<input type="text" id="update_product_id" name="update_product_id" value="'.$product_id.'" hidden>
<button type="submit" class="btn btn-red btn-xs delete" id="'.$product_order_id.'">&#9747;</button>
</td>



</tr>
';

}
}
else
  {
}
echo'
<tr>
<td style="text-align: center;"><strong>Total Price</strong></td>

'; 
$sql = "SELECT SUM(price) AS total, SUM(quantity) AS total_quantity FROM product_order WHERE product_order.order_status = 'Unpaid' AND product_order.user_id='$user_id'";
$result1 = $con->query($sql);
if($result1->num_rows > 0){
while($row1 = $result1->fetch_assoc()){
$total = $row1['total'];
$total_quantity = $row1['total_quantity'];

}}
echo' 
<td style="text-align: center;"><strong>'.$total_quantity.'</strong></td>
<td style="text-align: center;"><strong>RM '.$total.'</strong></td></tr>
</tbody>
<tr>
<td style="text-align: center;"></td>
';
  if($total_quantity == ""){
    echo '';
  }else{
    echo '<td style="text-align: right;"></td>
    <td style="text-align: center;">
    <a href="index.php" class="btn btn-blue btn-xs" >Continue Shooping</a>
    <a href="buy_now.php" class="btn btn-green btn-xs" >Buy Now</a></td>
  </tr>';
  }

echo '
</tbody>
<tfoot>
</tfoot>
</table>';




?>

