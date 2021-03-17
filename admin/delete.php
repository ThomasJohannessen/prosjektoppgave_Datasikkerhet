<?php
	session_start();
	if($_SESSION['user_type'] == 1)
   	{
		include "../database.php";
		include "../AppLogger.php";
		
		$db = new Database();
		$conn = $db->get_Connection();

		$epost = htmlspecialchars(trim($_GET['epost']));
		
		$sql = "CALL DeleteAUserAdmin('$epost')";

		$del = mysqli_query($conn, $sql);
		
		$logg = new AppLogger("brukertilgang");
		
		$logger = $logg->getLogger();

		$logger->notice("Admin deleted a user", ["Admin" => $_SESSION["user_email"], "Deleted_User_Email" => $epost]);

		if($del)
		{
   			mysqli_close($conn);
    			header("location:updateusers.php");
    			exit;	
		} else
 			echo "Error deleting user";
 	}
 	else
    		echo "Begone peasant. Admin only!";
?>
