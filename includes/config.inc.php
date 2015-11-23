<?php
	$host='localhost';
	$user='root';
	$pass='root';
	$dbname='hypercube';
	
	$db = mysqli_connect($host, $user, $pass, $dbname);
	if(mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: ".mysqli_connect_error();
		die("Failed");
	}
?>
