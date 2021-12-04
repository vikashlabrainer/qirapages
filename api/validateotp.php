<?php
session_start();
include (__DIR__ .'/../define.php');	
include (__DIR__ .'/../functions/function.php');	
 
if(isset($_SESSION['otpsent'], $_SESSION['token'])){
	
	$token_from_server = $_SESSION['otpsent'];
	$json = file_get_contents('php://input');
    $data = json_decode($json, true);
	$tokenfromclient = $data['token'];
	$otp = $data['otp'];
	if((!empty($otp)) && (!empty($tokenfromclient))){
	
	if($tokenfromclient == $_SESSION['token']){
	
	//echo $otp;
	//echo $tokenfromclient;
	$realotp =  decrypt($token_from_server);
	if($realotp==$otp){
		

		$_SESSION['logged']=1;
	 echo json_encode(array("msg"=>"<b>* Congrats! You'll receive updates every 5 minutes</b>", "statusCode"=>200));
		
		
	}
	
	else{
		
		echo json_encode(array("error"=>"<b>* Please enter correct OTP</b>", "statusCode"=>400));
	}
	}
	else{
		
		echo json_encode(array("error"=>"<b>* Token Key Mismatch</b>", "statusCode"=>400));
	}
	}
	else{
		echo json_encode(array("error"=>"<b>* Some fields are missing", "statusCode"=>400));
		
	}
	
}

else{
	
	echo json_encode(array("error"=>"<b>* Something went wrong.</b>", "statusCode"=>400));
	}





?>