<?php
	session_start();
	if($_SESSION['user_type'] === 1)
   	{
   		include "dbconnection.php";
   		
		$id = htmlspecialchars(trim($_GET['id']));

		$qry = mysqli_query($conn,"update brukere set Brukerstatus=1 where BrukerID='$id'");

		if($qry)
		{
    			mysqli_close($conn);
    			header("location:updateusers.php");
    			exit;	
		}
		else
    			echo "Error approving teacher status";
    	}
    	else
    		echo "Begone peasant. Admin only!";

?>
