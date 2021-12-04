<?php
include '../config/dbconnect.php';
if(isset($_POST['captcha']) && !empty($_POST['captcha'])){
    $secretKey = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';
    
	$verifyResponse = file_get_contents('https://google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['captcha']); 
    

    $responseData = json_decode($verifyResponse); 
    

}
else{
     echo json_encode(array("error"=>"Google Captcha Missing", "statusCode"=>300));
            return;
}

?>