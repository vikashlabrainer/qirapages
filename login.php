<?php
session_start();
$token = openssl_random_pseudo_bytes(16);
$token = bin2hex($token);
$_SESSION['token'] = $token;
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>

<div class="container">
<img src="https://ftx-rp.netlify.app/img/ftx21.webp"/>
<h1>Login to Qirapage</h1>
<div>
<sub>By default your OTP is 101010.</sub>
</div>

<div id="responder"></div>
<div>
<form id="frm1">

<input type="text" name="newuser" id="mobilex" autocomplete="off" placeholder="Enter your phone number"/>
<input type="hidden" name="xsrf-token" id="xsrf" autocomplete="off" value="<?php echo $token?>"/>
<div>

<input type="submit" class="submit" name="sb1" value="Get OTP"/>
</div>
</form>
<form id="otpbox">

<input type="password" name="otp" id="userotp" autocomplete="off" placeholder="One Time Password"/>
<input type="hidden" name="xsrf-token" id="xsrf-otp" autocomplete="off" value="<?php echo $token?>"/>

<div>
<input type="button" class="submit" name="changmobile" id="changmobile1" value="Change Mobile number"/>
<input type="submit" class="submit" name="sb2" value="Login"/>
</div>


</form>

</div>
<div>

</div>
</div>
<script src="script/login.js"></script>
</body>

</html>
