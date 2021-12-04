<?php

function encrypt($string)
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'VikashKumar'; // user define private key
    $secret_iv = '5fgf5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    
    return $output;
}


function decrypt($string)
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'VikashKumar'; // user define private key
    $secret_iv = '5fgf5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
	$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}
function validatemobile($mob){
if(preg_match("/^\d+\.?\d*$/",$mob) && strlen($mob)==10){

return 1;

}else{

return 0;

}
}



?>