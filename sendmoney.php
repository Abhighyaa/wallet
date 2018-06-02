<!DOCTYPE html>
<html>
<head>
	<title>Send money</title>
</head>
<body>
	<form action="<?php _SERVER['PHP_SELF']?>" method= "post">
		Mobile 	: <input type="text" name="mobile" required><br>
		Amount : <input type="text" name="amount" required><br>
		<input type="submit">
	</form>
</body>
</html>
<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){
		session_start();
		$SERVER = 'localhost';
		$username = 'root';
		$passwd = 'root';
		$dbname = 'wallet';
		$conn = new mysqli($SERVER,$username,$passwd,$dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$mobile=$_POST['mobile'];
		$amount = $_POST['amount'];
		$sql_m = "SELECT * from user where mobile = '$mobile' ";
		$result_m = $conn->query($sql_m);

		$user_m= $_SESSION['mobile'];
		$sql_a = "SELECT * FROM user where mobile='$user_m'";
		$result_a = $conn->query($sql_a);


		if ($result_a->num_rows > 0) {
		
    		while($row_a = $result_a->fetch_assoc()) {
    		
        		
        		$self_bal = $row_a['bal'];

    		}

    		if($self_bal>=$amount){
    			if ($result_m->num_rows > 0) {
		
					while($row_m = $result_m->fetch_assoc()) {
				
						$bal1=$row_m['bal']+$amount;
						$bal2= $self_bal-$amount;

						$update1 = "UPDATE user set bal='$bal1' where mobile = '$mobile'";
						$update2 = "UPDATE user set bal='$bal2' where mobile = '$user_m'";
						$transaction = "INSERT INTO transactions (sent_by,sent_to,amount) VALUES ('$user_m','$mobile','$amount')";

						if (($conn->query($update1) === TRUE)and($conn->query($update2) === TRUE)and($conn->query($transaction) === TRUE)) {
							echo "Transferred";
						}
					}
				}
				else{
				echo "Error: You are trying to send ".$amount."to an invalid user. ";
				}
    		}

    		else{
    			echo "Sorry, unsufficient balance!!";
    		}

		
		} 
	

	}
?>