<?php
session_start();
include __DIR__ .'/define.php';
require __DIR__ .'/config/dbconnect.php';

if(isset($_SESSION['logged'], $_SESSION['mobile'])){
	
	$mobile = $_SESSION['mobile'];
	
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
		
		$money = $moneycredited-$moneydebited;
	
	 
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
	<div style="margin:40px">
	
	<a href="index.php" class="btn-primary">Create Page</a>
	
	
	
	
	</div>
	<h1>Withdrawal</h1>
	<form name="withdrawal" method="post" action="withdrawal.php">
	<input type="text" name="withdraw" placeholder="Enter amount to withdraw"/>
	<input type="submit" value="Withdraw Balance"/>
	</form>
	
	</div>
	
	</body>
	
	</html>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	<?php
	
}
else{
	
	echo("Logged out");
}

?>

