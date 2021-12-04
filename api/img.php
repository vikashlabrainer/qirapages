<?php 
header("Content-Type: image/jpeg");
include __DIR__ .'/../functions/function.php';
$url = $_GET['url'];
$url  = decrypt($url);
//echo $url;



imageJPEG($image, NULL, 75);

?>