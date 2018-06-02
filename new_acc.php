<!DOCTYPE html>
<html>
<head>
	<title>New_acc</title>
</head>
<body>
	<?php
		$config = array(
        "digest_alg" => "sha512",
        "private_key_bits" => 4096,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    	);
    	$res = openssl_pkey_new($config);
    	openssl_pkey_export($res, $privKey);
    	$pubKey = openssl_pkey_get_details($res);

    	$file_pub = '/var/www/html/wallet/pub_key.txt';
    	$file_priv =  '/var/www/html/wallet/priv_key.txt';
    	$handle_pub = fopen($file_pub, 'w') or die('Cannot open file:  '.$file_pub);
    	$handle_priv = fopen($file_priv, 'w') or die('Cannot open file:  '.$file_priv);
    	fwrite($handle_pub, $pubKey["key"]);
    	fwrite($handle_priv, $privKey);
    	$SERVER = 'localhost';
		$username = 'root';
		$passwd = 'root';
		$dbname = 'wallet';
		$conn = new mysqli($SERVER,$username,$passwd,$dbname);
		if ($conn->connect_error) {
	    	die("Connection failed: " . $conn->connect_error);
		} 
		$publ=$pubKey["key"];
		$hash_add = hash('sha256','$privKey');
		$sql = "INSERT INTO pub_priv_key(pub,hash) VALUES ('$publ','$hash_add') ";

		?>
		
	<?php if ($conn->query($sql) === TRUE):?>
	Your <a href="download_pub.php">public key</a><br><br><br>
	Your <br><a href="download_priv.php"> private key</a><br><br><br>
	<a href="ann_index.php">Logout</a>
<?php else: ?>
	Couldn't generate the keys, please <a href="ann_index.php">try again.</a>
<?php endif;?>
</body>
</html>