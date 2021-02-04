<?php
	session_start();
	if($_SESSION['user_type'] == 1)
   	{
		include "../database.php";
		$db = new Database();
		$conn = $db->get_Connection();

		$id = htmlspecialchars(trim($_GET['id']));

		$del = mysqli_query($conn,"delete from meldinger where sporsmalID = '$id'");

		if($del)
		{
   			mysqli_close($conn);
    			header("location:adminfeed.php");
    			exit;	
		} else
 			echo "Error deleting message";
 	}
 	else
    		echo "Begone peasant. Admin only!";
?>
