<?php

session_start();
if(isset($_SESSION['logged'], $_SESSION['mobile'])){
	
	$mobile = $_SESSION['mobile'];
	
	
	?>
	
	
	<html>
	<head>
	<title>Dashboard</title>
	<style>
	.container{
		
	display: flex;
    flex-direction: column;
    
    align-content: stretch;
    justify-content: flex-end;
    align-items: center;
		
	}
	</style>
	</head>
	
	<body>
	
	<div class="container">
	
	<div>
	
	Welcome! <?php echo $mobile?>
	
	</div>
	
	<div>
	
	<h1>Wallet Balance: </h1>
	
	</div>
	<div>
	
	<a href="index.php" class="btn-primary">Create Page</a>
	
	<a href="" class="btn-primary">Withdraw Balance</a>
	
	
	</div>
	
	
	</div>
	
	</body>
	
	</html>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php
	
}
else{
	
	echo("Logged out");
}

?>

