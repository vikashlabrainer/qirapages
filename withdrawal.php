<?php
session_start();
include __DIR__ .'/define.php';
require __DIR__ .'/config/dbconnect.php';
if(!isset($_SESSION['logged'], $_SESSION['mobile'], $_POST['withdraw'])){
	
	header("Location: login.php");
	
}
else{
	$mobile= $_SESSION['mobile'];
	
	$sql ="SELECT amount FROM ".TABLE_PAYMENTS." where seller='$mobile'";
	$result = $conn->query($sql);
	$rowresult = mysqli_query($conn, $sql);
	$moneycredited = 0;
        if ( $rowresult->num_rows > 0) {
          
             while ($rowsum = mysqli_fetch_assoc($rowresult)){
                 $moneycredited +=  $rowsum['amount'];
                 }
		}
		
	$sqlwithdrawal ="SELECT amount FROM ".WITHDRAWAL_PAYMENTS." where number='$mobile'";
	$result = $conn->query($sqlwithdrawal);
	$rowresult = mysqli_query($conn, $sqlwithdrawal);
	$moneydebited = 0;
        if ( $rowresult->num_rows > 0) {
          
             while ($rowsum = mysqli_fetch_assoc($rowresult)){
                 $moneydebited +=  $rowsum['amount'];
                 }
		}
		
		
		
		$money_can_be_debitted = $moneycredited-$moneydebited;
		
		$withdrawalrequest = $_POST['withdraw'];
		
		if($withdrawalrequest > $money_can_be_debitted){
			
			echo("No amount to withdraw");
			
		}
		else{
			
			
			$money_to_raz = $withdrawalrequest*100;
			// calling the Razorpay X payout link
			$curl = curl_init();
			curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.razorpay.com/v1/payout-links",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{\n  \"account_number\": \"2323230035887079\",\n  \"contact\": {\n    \"name\": \"Rghap\",\n    \"type\": \"customer\",\n    \"contact\": \"$mobile\",\n    \"email\": \"\"\n  },\n  \"amount\": \"$money_to_raz\",\n  \"currency\": \"INR\",\n  \"purpose\": \"payout\",\n  \"description\": \"Anonpe Fund Transfer\",\n  \"receipt\": \"\",\n  \"send_sms\": true,\n  \"send_email\": false,\n  \"notes\": {\n    \"random_key_1\": \"Anonpe Fund Transfer\"\n    \n  }\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Basic cnpwX3Rlc3RfbVpCeTc1U1o3eGtLQ1Q6WjAxdnRScnhqaGQ5d1NwVE9yYklxdTRJ"
  ),
));

$response = curl_exec($curl);
$json = json_decode($response, true);
print_r($json);

curl_close($curl);



			
			$sql_redeem_insert = "INSERT INTO ".WITHDRAWAL_PAYMENTS." (number, amount) VALUES ('$mobile', '$withdrawalrequest')";
			
			$result = mysqli_query($conn, $sql_redeem_insert);
			
			print_r($result);
			
			
			
			
			
			
			
			
			
			
		}
		
		
	
	 
	
}



?>