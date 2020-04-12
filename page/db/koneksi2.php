<?php

	$host = "localhost";
	$user = "root";
	$password ="";
	$db = "plusphone";

	// Connect to server and select databse.
	$connection = mysqli_connect($host, $user, $password, $db) or die("cannot connect"); 
	mysqli_select_db($connection, $db) or die("cannot select DB");
?>