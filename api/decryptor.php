<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require __DIR__ .'/../config/dbconnect.php';	
require __DIR__ .'/../razorpay-php/Razorpay.php';
include __DIR__ .'/../define.php';	
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
$keyId = RAZORPAY_KEY;
$keySecret = RAZORPAY_SECRET;
$api = new Api($keyId, $keySecret);
$success = false;

if(isset($_POST['url'], $_POST['paymentid'], $_POST['signature'])){
	
    try
    {
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['paymentid'],
            'razorpay_signature' => $_POST['signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
		//print_r($api->utility);
        $success = true;
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }

}
if ($success === true)
{
    $url = $_POST['url'];
	$sql = "SELECT * FROM ".TABLE_NAME." WHERE uniqlink= '$url'";
   $result = mysqli_query($conn, $sql);
   
   if (mysqli_num_rows($result) > 0) 
    { 
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $json = $row['json'];
		
      
    } 
  

$json = urldecode($json);


$json = json_decode($json,true);



$finalx = htmlspecialchars_decode(json_encode($json));


print_r($finalx);
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}
?>