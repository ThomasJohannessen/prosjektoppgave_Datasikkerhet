<?php

	include "dbconnection.php";

	$id = $_GET['id'];

	$qry = mysqli_query($conn,"update brukere set Brukerstatus=1 where BrukerID='$id'");

	if($qry)
	{
    		mysqli_close($conn);
    		header("location:updateusers.php");
    		exit;	
	}
	else
    		echo "Error approving teacher status"; 

?>
