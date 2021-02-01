<?php
	$host = "localhost";
	$username = "admin";
	$password = "password";
	$db_name = "linuxconfig";
	
	$conn = new mysqli($host, $username, $password, $db_name);

	if ($conn->connect_error)
	{
		echo mysqli_connect_error();
  		die("Connection failed: " . $conn->connect_error);
	}
?>
