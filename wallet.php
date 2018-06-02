<!DOCTYPE html>
<html>
<head>
	<title>Wallet</title>
</head>
<body>
	<?php session_start();?>
	<?php if(isset($_SESSION['mobile'])):?>
		<form >
		<a href="checkbal.php"> Check Balance </a><br>
		<a href="sendmoney.php"> Send money </a><br>
		<a href="viewtransaction.php"> View Transactions </a><br>
		<a href="logout.php"> Logout </a><br>
	</form>
	<?php else:
			header('location:index.html');
		
	?>
	<?php endif; ?>
</body>
</html>