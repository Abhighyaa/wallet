<!DOCTYPE html>
<html>
<head>
	<title>Check your balance</title>
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
		
		$sql = "SELECT * FROM user where mobile='$mobile'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {

        		$name=$row['name'];
        		$bal=$row['bal'];
    		}
    	} 
$conn->close();
	echo "Hi ".$name."!!<br><br>Your balance is ".$bal;

	}
	else{
		header('location:index.html');
	}
		
	?>
	

</body>
</html>