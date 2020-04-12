<?php

	$host = "localhost";
	$user = "root";
	$password ="";
	$db = "portalweb";

	// Connect to server and select databse.
	$connection = mysqli_connect($host, $user, $password, $db) or die("cannot connect"); 
	mysqli_select_db($connection, $db) or die("cannot select DB");
	
	if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>