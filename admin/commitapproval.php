<?php
	session_start();
	if($_SESSION['user_type'] == 1)
   	{
		include "../database.php";
		include "../AppLogger.php";
		
		$db = new Database();
		$conn = $db->get_Connection();
   		
		$epost = htmlspecialchars(trim($_GET['email']));
		
		$sql = "CALL CommitApprovalOfLecturerRequest('$epost')";

		$qry = mysqli_query($conn, $sql);

		$logg = new AppLogger("brukertilgang");
		
		$logger = $logg->getLogger();

		$logger->notice("Admin approved a lecturer", ["Admin" => $_SESSION["user_email"], "Approved_lecturer_Email" => $epost]);
		

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
