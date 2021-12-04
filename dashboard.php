<?php
session_start();
include __DIR__ .'/define.php';
require __DIR__ .'/config/dbconnect.php';

if(isset($_SESSION['logged'], $_SESSION['mobile'])){
	
	$mobile = $_SESSION['mobile'];
	
	$sql ="SELECT amount FROM ".TABLE_PAYMENTS." where seller='$mobile'";
	$result = $conn->query($sql);
	$rowresult = mysqli_query($conn, $sql);
	$money = 0;
        if ( $rowresult->num_rows > 0) {
          
             while ($rowsum = mysqli_fetch_assoc($rowresult)){
                 $money +=  $rowsum['amount'];
                 }
		}
	
	 
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
	
	<h1>Wallet Balance: INR <?php echo $money?></h1>
	
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

