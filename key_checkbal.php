<!DOCTYPE html>
<html>
<head>
	<title>Check your balance</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

	To view your balance, enter your private key here:<br>
	<input type="text" name="privKey"><br><br><br>
	<input type="submit" name="Chek balance"><br><br>		

	</form>

	<?php

	if($_SERVER['REQUEST_METHOD']=="POST"){

		$privKey = $_POST['privKey'];
		$hash_add = hash('sha256','$privKey');
		$sql = "SELECT * from pub_priv_key where hash = '$hash_add' ";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			echo "hellp";
    		while($row = $result->fetch_assoc()) {

        		
        		$bal=$row['bal'];
    		}
    		echo "Hi !!<br><br>Your balance is ".$bal;			
		}
		else{
			echo "Key not registered.";
		}


	}

	?>

</body>
</html>