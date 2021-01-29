<?php

	include "dbconnection.php";

	$id = $_GET['id'];

	$del = mysqli_query($conn,"delete from brukere where BrukerID = '$id'");

	if($del)
	{
   		mysqli_close($conn);
    		header("location:updateusers.php");
    		exit;	
	} else
 		echo "Error deleting user"; 	
?>
