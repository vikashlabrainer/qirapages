<?php 
session_start();
include __DIR__ .'/../define.php';
include (__DIR__ .'/../functions/function.php');	
if(isset($_SESSION['token'])){
	$json = file_get_contents('php://input');
    $data = json_decode($json, true);
	$mobile = $data['mobile'];
	$token = $data['xsrf'];
	if($token == $_SESSION['token']){
		
		if(validatemobile($mobile)==1){
		//$otp = sendotpviaaws($filtered_mobile);
		$curl = curl_init();
$otp = 101010;
$_SESSION['mobile'] =$mobile;
			$encryptpedotp = encrypt($otp);
			$_SESSION['otpsent'] = $encryptpedotp;
			echo json_encode(array("token"=>$encryptpedotp, "msg"=>"<b>* OTP sent to your Mobile</b>", "statusCode"=>200));
			
		}
	
	else{
		echo json_encode(array("error"=>"Mobile number format is wrong", "statusCode"=>400));
	}
	}
	
	else {
    echo json_encode(array("error"=>"<b>* Enter Correct Mobile Number</b>", "statusCode"=>400));
	}
	}
	else{
		
  echo json_encode(array("error"=>"<b>* Refresh the page</b>", "statusCode"=>400));
	}
	



?>