<?php


$url = $_GET['url'];
$sql= "SELECT * FROM ".TABLE_NAME."WHERE uniqlink= '$url'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
	
{ 

$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$json = $row['json'];

echo $json;

} 
else{
	
	echo("no file found";
}


?>