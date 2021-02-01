<?php

	$host = "localhost";
    	$username = "DBuser";
    	$password = "DBpassord";
	$db_name = "datasikkerhet_prosjekt"; 
	
	$conn = new mysqli($host, $username, $password, $db_name);

	if ($conn->connect_error)
	{
		echo mysqli_connect_error();
  		die("Connection failed: " . $conn->connect_error);
	}
?>
