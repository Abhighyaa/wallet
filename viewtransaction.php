<!DOCTYPE html>
<html>
<head>
	<title>Wallet Transactions</title>
</head>
<body>
	<?php
	 
		session_start();
		if(isset($_SESSION['mobile'])){

			$SERVER = 'localhost';
		$username = 'root';
		$passwd = 'root';
		$dbname = 'wallet';
		$conn = new mysqli($SERVER,$username,$passwd,$dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		$mobile= $_SESSION['mobile'];
		$sql = "SELECT * FROM transactions where sent_to='$mobile' or sent_by='$mobile'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {

        		if($row['sent_to']==$mobile){
        			echo $row['sent_by']."     ".$row['sent_to']."      ".$row['amount']."      "."Credit<br>";
        		}
        		else{
        			echo $row['sent_by']."     ".$row['sent_to']."      ".$row['amount']."      "."Debit<br>";
        		}
    		}
    	} 
    	else{
    		echo "No transactions to display";
    	}
$conn->close();			

		}
		else{
			header('location:index.html');
		}
		
	
	?>
</body>
</html>