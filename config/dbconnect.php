<?php 
$servername = "";   //ENTER YOUR SERVER NAME HERE
$username = "";   //ENTER USERNAME OF THE DATABASE
$password = "";			//ENTER PASSWORD OF THE DATABASE
$database = "";		// ENTER DATABSE NAME 

try {

$conn = mysqli_connect($servername, $username, $password, $database);

}

catch(Exception $e) {
  echo json_encode(array("statusCode"=>201));
}




?>
