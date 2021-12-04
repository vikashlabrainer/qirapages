<?php
require ('config/dbconnect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


 $json = file_get_contents('php://input');

$object = json_decode($json, true);
$txnid = ($object['payload']['payment']['entity']['id']);
$amount = ($object['payload']['payment']['entity']['amount'])/100;
$orderid = ($object['payload']['payment']['entity']['order_id']);
$payment_mode = ($object['payload']['payment']['entity']['method']);
$email = ($object['payload']['payment']['entity']['email']);
$buyeridentity = ($object['payload']['payment']['entity']['contact']);
$created_at = ($object['payload']['payment']['entity']['created_at']);
$fee = ($object['payload']['payment']['entity']['fee']);
// $amount = $amount-$fee;
$datetime = new DateTime("@$created_at");
$datetimeFormat = $datetime->format('d-m-Y H:i:s');
$timezoneFrom="UTC";
$timezoneTo='Asia/Kolkata';
$displayDate = new DateTime($datetimeFormat, new DateTimeZone($timezoneFrom));
$displayDate->setTimezone(new DateTimeZone($timezoneTo));
$txndate = $displayDate->format('d-m-Y H:i:s');
$identity = ($object['payload']['payment']['entity']['notes']['merchant_order_id']);
$sqlw = "SELECT * FROM `ftx` WHERE uniqlink = '$identity'";
$resultx = mysqli_query($conn, $sqlw);
$row = mysqli_fetch_array($resultx,MYSQLI_ASSOC);
$uid = $row['number'];

$sqiupda = "INSERT INTO ftx_payments(uniqlink,seller, buyernumber,amount, txnid, orderid, paymnet_mode, txndate, email_buyer) VALUES ('$identity','$uid','$buyeridentity', '$amount', '$txnid', '$orderid','$payment_mode', '$txndate','$email')"; 
try {
   $result5 = mysqli_query($conn, $sqiupda);

   
}
catch (exception $e) {
   echo $e;
}
}
else{
	
	 die(header('HTTP/1.0 415 Unsupported Media Type'));
	
}

?>