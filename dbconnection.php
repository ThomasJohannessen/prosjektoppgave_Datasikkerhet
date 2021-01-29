<?php
	$servername = "localhost";
	$username = "admin";
	$password = "password";
	$dbname = "datasikkerhet_prosjekt";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error)
	{
		echo mysqli_connect_error();
  		die("Connection failed: " . $conn->connect_error);
	}
?>
