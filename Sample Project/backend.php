
<?php 

include 'm2upay_backend/M2UPay.php';
use M2U\M2UPay;
//Pass in 3 parameters 
$m2u_json= array(
  'amount'=>60.00,
  'accountNumber'=>"INVOICE000123",
  'payeeCode'=>"***"
);

$envType = 1; 
$M2UPay = new M2UPay(); 
//Return the encrypted string and actionUrl as Merchant API response 
echo $M2UPay->getEncryptionString($m2u_json,$envType);

;?>

