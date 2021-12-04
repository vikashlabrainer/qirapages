<?php
include __DIR__ .'/../define.php';	
require __DIR__ .'/../config/dbconnect.php';
if(isset($_POST['captcha']) && !empty($_POST['captcha'])){
	
    $secretKey = CAPTCHA_SECRET;
    
	$verifyResponse = file_get_contents('https://google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['captcha']); 
    

    $responseData = json_decode($verifyResponse); 
    
	if($responseData->success){
           
         // echo("Google success");
    
	if (isset($_POST['url']) && ($_POST['amount']) && ($_POST['metadata'])) {
        
		$payload = $_POST["url"];
        
		$amount = mysqli_real_escape_string($conn,trim($_POST['amount']));
        
		$title  = mysqli_real_escape_string($conn,trim($_POST['metadata'])); 
        
		// HARD CODING PHONE NUMBER OF THE USER AND LATER I WILL BE REPLACING THIS TO SESSION VARIABLE
		
		$number = '1234567890';  
        
		
		if(empty($payload))
        
		{
        
		echo json_encode(array("error"=>"You have not written any story", "statusCode"=>300));
        
		return;
        
		}
        
		if(empty($amount)){
        
		echo json_encode(array("error"=>"Enter correct story value", "statusCode"=>300));
        
		return;
        
		}
        
		if(!is_numeric($amount)) {
        
		echo json_encode(array("error"=>"Data entered was not numeric", "statusCode"=>300));
        
		return;
        
		} 
                        
        
		if($amount<2 || $amount>=10000) // phone number is valid
        
		{
		
        echo json_encode(array("error"=>"Story Value must be in the range of INR 2-9999", "statusCode"=>300));
        
		return;

        
		}
        
		if(empty($title))
        
		{
        
		echo json_encode(array("error"=>"Story title is required.", "statusCode"=>300));
        
		return;
        
		}
        
		if(strlen($title)<4)
        
		{
        
		echo json_encode(array("error"=>"Story title length is too small", "statusCode"=>300));
        
		return;
        
		}
        
        $payloadx = mysqli_real_escape_string($conn,$payload);
                
		
		$currentTimeinSeconds = time();
        
        $pw = chr(mt_rand(97,122)).mt_rand(0,9).chr(mt_rand(97,122)).mt_rand(10,99).chr(mt_rand(97,122)).mt_rand(100,999);
        
		//$pwx = chr(mt_rand(97,122)).mt_rand(0,9).chr(mt_rand(97,122)).mt_rand(10,99).chr(mt_rand(97,122)).mt_rand(100,999);
		
		
		$link_u = "FTX-$pw";
               
        
		$sql = "INSERT INTO ".TABLE_NAME." (number,uniqlink,json,amount,title) VALUES ('$number','$link_u', '$payloadx', '$amount', '$title')";
                       
        $result = mysqli_query($conn, $sql);
               
		if ($result == 1){

		$tellbeneficiary = "https://".($_SERVER['HTTP_HOST'])."/qirapages/public.php?url=".$link_u;
    
    
		echo json_encode(array("link"=>$tellbeneficiary, "statusCode"=>200));		
		
		return;
		
		}
		
		else{
			
		echo json_encode(array("error"=>"Technical Issue.", "statusCode"=>300));
    
    
		}
        
            }
            
			else{
                
                // Complete the required fields and must write any story.
                echo json_encode(array("error"=>"Some Fields are empty.", "statusCode"=>300));
                return;
            }
            
            
            
            
        }
        else{
            echo json_encode(array("error"=>"Google Captcha Expired", "statusCode"=>300));
            return;
            // echo("Google Captcha Error");
        }
}
else{
     echo json_encode(array("error"=>"Google Captcha Missing", "statusCode"=>300));
            return;
}

?>