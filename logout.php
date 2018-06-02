<?php
	session_start();
	unset($_SESSION['mobile']);
	session_destroy();

	header('location:index.html');

?>