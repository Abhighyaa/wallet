<?php
	session_start();
	if($_SERVER['REQUEST_METHOD']=="POST"){
	
	$SERVER = 'localhost';
	$username = 'root';
	$passwd = 'root';
	$dbname = 'wallet';
	$conn = new mysqli($SERVER,$username,$passwd,$dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$mobile = $_POST['mobile'];
	$password=$_POST['password'];

	$sql = "SELECT * from user where mobile = '$mobile' and password = '$password'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		
		
		$_SESSION['mobile'] = $_POST['mobile'];
		/*$mbl = $_POST['mobile'];*/
		
		//session_set($_SESSION['mobile'] );
		$sql = "SELECT * FROM user where mobile='$mobile'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {

        		$name=$row['name'];
        		$bal=$row['bal'];
    		}
		
    	header('location: wallet.php');
    }
	} 
	else {
    	echo "Error: Invalid mobile no or password" ;
	}
	
	$conn->close();
	}
?><html>
<head>
	<title>Wallet Signin</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		Mobile 	: <input type="text" name="mobile" required><br>
		Password:<input type="password" name="password" required><br>
		<input type="submit">
	</form>
</body>
</html>
