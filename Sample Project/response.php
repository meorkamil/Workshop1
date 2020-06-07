
<?php 

$data = json_decode(file_get_contents('php://input'), true);

header('Content-Type: application/json');

//This is an acknowledgement message to be response back to M2U after Realtime Payment Notification has been received by payee

//StatusCode can be refered in https://m2upay.maybank2u.com.my/ for the right statussdk#realtime-payment-notification
$Msg = array(
	'PmtType' => $data['Msg']['PmtType'],
	'RefId' => $data['Msg']['RefId'],
	'StatusCode' => ''
);

$Response = array('Msg' => $Msg);

//Check if the purchase ref number / invoice number/ bill number is match with the one pass to Maybank in backend.php & check the transaction status receive from Maybank
if ($data["Msg"]["AcctId"] == "INVOICE000123") {
	if ($data["Msg"]["StatusCode"] == "00") {
		//Transaction successful
		$Response["Msg"]['StatusCode'] = '0';
        echo json_encode($Response);
	}
	else if ($data["Msg"]["StatusCode"] == "01") {
		//Transaction unsuccessful
		$Response["Msg"]['StatusCode'] = '0';
        echo json_encode($Response);
	}
}
else{
	//Invalid transaction. ;
	$Response["Msg"]['StatusCode'] = '101';
	echo json_encode($Response);
}
;?>
