<html>
<head>
	<title>Wallet Signup</title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		Name 	: <input type="text" name="name" required><br>
		Password: <input type="password" name="password" required><br>
		Mobile :<input type="text" name="mobile" required><br>
		<input type="submit" >
	</form>
	
</body>
</html>
<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){
	
	$SERVER = 'localhost';
	$username = 'root';
	$passwd = 'root';
	$dbname = 'wallet';
	$conn = new mysqli($SERVER,$username,$passwd,$dbname);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$name = $_POST['name'];
	$password=$_POST['password'];
	$mobile=$_POST['mobile'];

	if(!empty($mobile)){
		if(preg_match('/^\d{10}$/', $mobile)){
				$sql = "INSERT INTO user (name , password,mobile) 
				VALUES ('$name','$password','$mobile' ) ";
				if ($conn->query($sql) === TRUE) {
    				session_start();
		
					$_SESSION['mobile'] = $_POST['mobile'];
		//session_set($_SESSION['mobile'] );
    				header('location: wallet.php');
				} 
				else {
    				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		}
	}
	else{
		echo "Please enter mobile no.";
	}

$conn->close();
}
?>